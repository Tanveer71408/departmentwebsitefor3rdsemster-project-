<?php
// db_init.php - provides a PDO connection to MySQL and ensures required tables exist

function get_mysql_config() {
    $cfgFile = __DIR__ . '/db_config.php';
    if (!file_exists($cfgFile)) {
        throw new Exception('Missing db_config.php - copy and edit Backend/api/db_config.php');
    }
    return include $cfgFile;
}

function get_db() {
    $cfg = get_mysql_config();

    $host = $cfg['host'] ?? '127.0.0.1';
    $port = $cfg['port'] ?? 3306;
    $user = $cfg['user'] ?? 'root';
    $pass = $cfg['pass'] ?? '';
    $dbname = $cfg['dbname'] ?? 'university_portal';
    $charset = $cfg['charset'] ?? 'utf8mb4';

    try {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        ensure_tables($pdo);

        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Database connection error: ' . $e->getMessage()]);
        exit;
    }
}

function ensure_tables(PDO $pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) UNIQUE,
        name VARCHAR(255),
        email VARCHAR(255) UNIQUE,
        password_hash VARCHAR(255),
        role VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $pdo->exec($sql);

    $sql2 = "CREATE TABLE IF NOT EXISTS courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(50) UNIQUE,
        title VARCHAR(255),
        description TEXT,
        credits INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $pdo->exec($sql2);

    $sql3 = "CREATE TABLE IF NOT EXISTS assignments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT,
        title VARCHAR(255),
        description TEXT,
        due_date DATETIME NULL,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL,
        FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $pdo->exec($sql3);

    // Seed sample users if table empty
    $stmt = $pdo->query('SELECT COUNT(*) AS cnt FROM users');
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $users = [
            ['username' => 'student1', 'name' => 'Student One', 'email' => 'student@example.com', 'password' => 'studentpass', 'role' => 'student'],
            ['username' => 'staff1', 'name' => 'Dr. Sajida', 'email' => 'staff@example.com', 'password' => 'staffpass', 'role' => 'staff'],
            ['username' => 'admin', 'name' => 'Admin User', 'email' => 'admin@example.com', 'password' => 'adminpass', 'role' => 'admin'],
        ];

        $ins = $pdo->prepare('INSERT INTO users (username, name, email, password_hash, role) VALUES (:username, :name, :email, :password_hash, :role)');
        foreach ($users as $u) {
            $ins->execute([
                ':username' => $u['username'],
                ':name' => $u['name'],
                ':email' => $u['email'],
                ':password_hash' => password_hash($u['password'], PASSWORD_DEFAULT),
                ':role' => $u['role']
            ]);
        }
    }
}

?>
