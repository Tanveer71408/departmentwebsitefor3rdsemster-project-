<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/db_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if ($username === '' || $password === '' || $role === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing username, password, or role']);
    exit;
}

$pdo = get_db();

$stmt = $pdo->prepare('SELECT id, username, name, email, password_hash, role FROM users WHERE (email = :u OR username = :u) AND role = :role LIMIT 1');
$stmt->execute([':u' => $username, ':role' => $role]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
    exit;
}

// Support legacy plaintext passwords in the DB for convenience during setup.
$stored = $user['password_hash'];
$verified = false;
if ($stored !== null && $stored !== '') {
    if (password_verify($password, $stored)) {
        $verified = true;
    } elseif ($password === $stored) {
        // legacy plaintext match: upgrade to hashed password
        try {
            $newhash = password_hash($password, PASSWORD_DEFAULT);
            $upd = $pdo->prepare('UPDATE users SET password_hash = :h WHERE id = :id');
            $upd->execute([':h' => $newhash, ':id' => $user['id']]);
            $verified = true;
        } catch (Exception $e) {
            // ignore upgrade failure, but allow login
            $verified = true;
        }
    }
}

if (!$verified) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
    exit;
}

// Successful login
unset($user['password_hash']);
$_SESSION['user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'name' => $user['name'],
    'email' => $user['email'],
    'role' => $user['role']
];

echo json_encode(['success' => true, 'user' => $_SESSION['user']]);

?>
