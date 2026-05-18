<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header('Location: ../Index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</p>
        <nav>
            <a href="../Index.php">Public Site</a> |
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>My Overview</h2>
            <p>Access courses, assignments, grades, and profile settings from the portal.</p>
            <ul>
                <li><a href="../Backend/api/courses.php">Available Courses (JSON)</a></li>
                <li><a href="../Backend/api/assignments.php">Assignments (JSON)</a></li>
            </ul>
        </section>
    </main>
</body>
</html>
