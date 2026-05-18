<?php
// db_config.php - MySQL connection settings
// Update these values to match your MySQL/MariaDB server
return [
    'host' => '127.0.0.1',
    'port' => 3306,
    'user' => 'root',
    'pass' => '',
    'dbname' => 'university_portal',
    // set to true to attempt CREATE DATABASE when running create_db.php
    'allow_create_database' => true,
    'charset' => 'utf8mb4'
];
