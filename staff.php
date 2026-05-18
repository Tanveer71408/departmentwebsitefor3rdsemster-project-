<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header('Location: ../Index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Faculty Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</p>
        <nav>
            <a href="../Index.php">Public Site</a> |
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Overview</h2>
            <p>Use the admin console for course and assignment management (if permitted).</p>
            <ul>
                <li><a href="../Backend/api/assignments.php">Assignments API (JSON)</a></li>
                <li><a href="../Backend/api/courses.php">Courses API (JSON)</a></li>
            </ul>
        </section>
    </main>
</body>
</html>
