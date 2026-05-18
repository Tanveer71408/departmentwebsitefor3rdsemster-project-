<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_init.php';

function is_admin_or_staff() {
    return isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','staff']);
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
    // optional ?course_id=
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
    if ($course_id > 0) {
        $stmt = $pdo->prepare('SELECT a.*, c.title AS course_title FROM assignments a LEFT JOIN courses c ON a.course_id=c.id WHERE course_id=:cid ORDER BY a.id DESC');
        $stmt->execute([':cid'=>$course_id]);
    } else {
        $stmt = $pdo->query('SELECT a.*, c.title AS course_title FROM assignments a LEFT JOIN courses c ON a.course_id=c.id ORDER BY a.id DESC');
    }
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'assignments' => $items]);
    exit;
}

if ($method === 'POST') {
    if (!is_admin_or_staff()) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Forbidden']);
        exit;
    }

    $action = $_POST['action'] ?? 'create';
    if ($action === 'create') {
        $course_id = intval($_POST['course_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = $_POST['description'] ?? '';
        $due_date = $_POST['due_date'] ?? null;
        $created_by = $_SESSION['user']['id'] ?? null;

        if ($course_id <= 0 || $title === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing course_id or title']);
            exit;
        }

        $ins = $pdo->prepare('INSERT INTO assignments (course_id, title, description, due_date, created_by) VALUES (:course_id, :title, :description, :due_date, :created_by)');
        $ins->execute([':course_id'=>$course_id,':title'=>$title,':description'=>$description,':due_date'=>$due_date,':created_by'=>$created_by]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        exit;
    }

    if ($action === 'update') {
        $id = intval($_POST['id'] ?? 0);
        $course_id = intval($_POST['course_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = $_POST['description'] ?? '';
        $due_date = $_POST['due_date'] ?? null;

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing id']);
            exit;
        }

        $up = $pdo->prepare('UPDATE assignments SET course_id=:course_id, title=:title, description=:description, due_date=:due_date WHERE id=:id');
        $up->execute([':course_id'=>$course_id,':title'=>$title,':description'=>$description,':due_date'=>$due_date,':id'=>$id]);
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
        $del = $pdo->prepare('DELETE FROM assignments WHERE id=:id');
        $del->execute([':id'=>$id]);
        echo json_encode(['success' => true]);
        exit;
    }
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);

?>
