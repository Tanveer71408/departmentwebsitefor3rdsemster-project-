<?php
// create_db.php - attempt to CREATE DATABASE (if allowed) and ensure tables exist
header('Content-Type: application/json; charset=utf-8');
try {
    $cfgFile = __DIR__ . '/db_config.php';
    if (!file_exists($cfgFile)) throw new Exception('Missing db_config.php');
    $cfg = include $cfgFile;

    $host = $cfg['host'] ?? '127.0.0.1';
    $port = $cfg['port'] ?? 3306;
    $user = $cfg['user'] ?? 'root';
    $pass = $cfg['pass'] ?? '';
    $dbname = $cfg['dbname'] ?? 'university_portal';
    $allowCreate = $cfg['allow_create_database'] ?? false;

    // If allowed, connect without dbname to create database
    if ($allowCreate) {
        $dsn = "mysql:host={$host};port={$port}";
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . str_replace('`','', $dbname) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    // Now use get_db() to create tables and seed
    require_once __DIR__ . '/db_init.php';
    $pdo = get_db();
    echo json_encode(['success' => true, 'db' => $dbname]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

?>
