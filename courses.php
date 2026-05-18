<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_init.php';

// simple auth: writes require admin role
function is_admin() {
    return isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin');
}

try {
    $pdo = get_db();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // list courses
    $stmt = $pdo->query('SELECT id, code, title, description, credits, created_at FROM courses ORDER BY id DESC');
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'courses' => $courses]);
    exit;
}

if ($method === 'POST') {
    if (!is_admin()) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Forbidden']);
        exit;
    }

    $action = $_POST['action'] ?? 'create';
    if ($action === 'create') {
        $code = trim($_POST['code'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $description = $_POST['description'] ?? '';
        $credits = intval($_POST['credits'] ?? 0);

        if ($code === '' || $title === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing code or title']);
            exit;
        }

        $ins = $pdo->prepare('INSERT INTO courses (code, title, description, credits) VALUES (:code, :title, :description, :credits)');
        $ins->execute([':code'=>$code,':title'=>$title,':description'=>$description,':credits'=>$credits]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        exit;
    }

    if ($action === 'update') {
        $id = intval($_POST['id'] ?? 0);
        $code = trim($_POST['code'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $description = $_POST['description'] ?? '';
        $credits = intval($_POST['credits'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing id']);
            exit;
        }

        $up = $pdo->prepare('UPDATE courses SET code=:code, title=:title, description=:description, credits=:credits WHERE id=:id');
        $up->execute([':code'=>$code,':title'=>$title,':description'=>$description,':credits'=>$credits,':id'=>$id]);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing id']);
            exit;
        }
        $del = $pdo->prepare('DELETE FROM courses WHERE id=:id');
        $del->execute([':id'=>$id]);
        echo json_encode(['success' => true]);
        exit;
    }
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);

?>
