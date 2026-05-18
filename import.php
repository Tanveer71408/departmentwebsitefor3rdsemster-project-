<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_init.php';

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

if (!is_admin()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Forbidden']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'File upload required']);
    exit;
}

$type = $_POST['type'] ?? '';
if (!in_array($type, ['users','courses','assignments'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid type']);
    exit;
}

$tmp = $_FILES['file']['tmp_name'];
if (($handle = fopen($tmp, 'r')) === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Unable to open uploaded file']);
    exit;
}

$pdo = get_db();
$row = 0;
$imported = 0;
$errors = [];

while (($data = fgetcsv($handle)) !== false) {
    $row++;
    // skip empty lines
    if (count($data) === 0) continue;
    // allow header row: if first cell is a string matching header names, skip
    if ($row === 1) {
        $first = strtolower(trim($data[0]));
        if (in_array($first, ['username','code','course_code','title'])) {
            continue; // treat as header
        }
    }

    try {
        if ($type === 'users') {
            // expected: username,name,email,password,role
            $username = trim($data[0] ?? '');
            $name = trim($data[1] ?? '');
            $email = trim($data[2] ?? '');
            $password = $data[3] ?? '';
            $role = trim($data[4] ?? 'student');
            if ($username === '' || $email === '' || $password === '') {
                $errors[] = "row $row: missing required user fields";
                continue;
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO users (username, name, email, password_hash, role) VALUES (:username, :name, :email, :password_hash, :role)');
            $ins->execute([':username'=>$username,':name'=>$name,':email'=>$email,':password_hash'=>$hash,':role'=>$role]);
            $imported++;
        } elseif ($type === 'courses') {
            // expected: code,title,description,credits
            $code = trim($data[0] ?? '');
            $title = trim($data[1] ?? '');
            $description = $data[2] ?? '';
            $credits = intval($data[3] ?? 0);
            if ($code === '' || $title === '') {
                $errors[] = "row $row: missing required course fields";
                continue;
            }
            $ins = $pdo->prepare('INSERT INTO courses (code, title, description, credits) VALUES (:code, :title, :description, :credits)');
            $ins->execute([':code'=>$code,':title'=>$title,':description'=>$description,':credits'=>$credits]);
            $imported++;
        } elseif ($type === 'assignments') {
            // expected: course_code,title,description,due_date,created_by_username
            $course_code = trim($data[0] ?? '');
            $title = trim($data[1] ?? '');
            $description = $data[2] ?? '';
            $due_date = $data[3] ?? null;
            $created_by_username = trim($data[4] ?? '');

            if ($course_code === '' || $title === '') {
                $errors[] = "row $row: missing required assignment fields";
                continue;
            }

            // find course id
            $stmt = $pdo->prepare('SELECT id FROM courses WHERE code = :code LIMIT 1');
            $stmt->execute([':code'=>$course_code]);
            $course = $stmt->fetch(PDO::FETCH_ASSOC);
            $course_id = $course ? $course['id'] : null;

            // find created_by id
            $created_by = null;
            if ($created_by_username !== '') {
                $s2 = $pdo->prepare('SELECT id FROM users WHERE username = :u OR email = :u LIMIT 1');
                $s2->execute([':u'=>$created_by_username]);
                $urow = $s2->fetch(PDO::FETCH_ASSOC);
                $created_by = $urow ? $urow['id'] : null;
            }

            $ins = $pdo->prepare('INSERT INTO assignments (course_id, title, description, due_date, created_by) VALUES (:course_id, :title, :description, :due_date, :created_by)');
            $ins->execute([':course_id'=>$course_id,':title'=>$title,':description'=>$description,':due_date'=>$due_date,':created_by'=>$created_by]);
            $imported++;
        }
    } catch (Exception $e) {
        $errors[] = "row $row: " . $e->getMessage();
        continue;
    }
}

fclose($handle);

echo json_encode(['success' => true, 'imported' => $imported, 'errors' => $errors]);

?>
