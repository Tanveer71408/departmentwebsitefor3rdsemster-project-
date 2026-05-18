<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../Index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Administrator Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</p>
        <nav>
            <a href="../Index.php">Public Site</a> |
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Management</h2>
            <ul>
                <li><a href="../admin/dashboard.php">Web Admin Console</a> (in-project admin tools)</li>
                <li><a href="../Backend/api/courses.php">Courses API (JSON)</a></li>
                <li><a href="../Backend/api/assignments.php">Assignments API (JSON)</a></li>
                <li><a href="../Backend/api/import.php">CSV Import API</a></li>
            </ul>
        </section>
    </main>
</body>
</html>
