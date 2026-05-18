<?php
// generate_hashes.php
// Convenience script to produce bcrypt password hashes for seeded users
// and optionally update the SQL dump at ../../database/university_portal.sql
// USAGE (from CLI):
// & 'C:\xampp\php\php.exe' 'C:\xamp\htdocs\university portal\Backend\api\generate_hashes.php'

$pairs = [
    // username => plaintext password
    'student1' => 'studentpass',
    'staff1' => 'staffpass',
    'admin' => 'adminpass'
];

$results = [];
foreach ($pairs as $user => $plain) {
    $hash = password_hash($plain, PASSWORD_DEFAULT);
    $results[$user] = $hash;
}

// Print hashes
echo "Generated password hashes:\n";
foreach ($results as $u => $h) {
    echo "$u => $h\n";
}

$sqlPath = __DIR__ . '/../../database/university_portal.sql';
if (file_exists($sqlPath)) {
    $sql = file_get_contents($sqlPath);

    // Replace INSERT INTO `users` block: find the users VALUES lines and replace empty '' password fields
    // This is a permissive replacement: for each username in $pairs, replace the first occurrence of the
    // pattern (username','name','email','') with username','name','email','<hash>'

    foreach ($results as $username => $hash) {
        // match the username in an INSERT values row and replace the empty password field that follows email
        $pattern = "/('" . preg_quote($username, '/') . "'\s*,\s*'[^']*'\s*,\s*'[^']*'\s*,)\s*''/i";
        $replacement = "$1 '" . $hash . "'";
        $newSql = preg_replace($pattern, $replacement, $sql, 1, $count);
        if ($count > 0) {
            $sql = $newSql;
        }
    }

    // write updated SQL to a new file for safety
    $outPath = __DIR__ . '/../../database/university_portal_with_hashes.sql';
    file_put_contents($outPath, $sql);
    echo "\nUpdated SQL written to: $outPath\n";
    echo "(Original file left unchanged at: $sqlPath)\n";
} else {
    echo "\nSQL dump not found at: $sqlPath - skipping SQL update.\n";
}

?>
