-- university_portal.sql
-- Schema for university_portal and sample data
-- Run this on your MySQL server (or use create_db.php to create DB and tables)

CREATE DATABASE IF NOT EXISTS `university_portal` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `university_portal`;

-- users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) UNIQUE,
  `name` VARCHAR(255),
  `email` VARCHAR(255) UNIQUE,
  `password_hash` VARCHAR(255),
  `role` VARCHAR(50),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- courses table
CREATE TABLE IF NOT EXISTS `courses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(50) UNIQUE,
  `title` VARCHAR(255),
  `description` TEXT,
  `credits` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- assignments table
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `course_id` INT,
  `title` VARCHAR(255),
  `description` TEXT,
  `due_date` DATETIME NULL,
  `created_by` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
-- NOTE: For convenience these example rows store plaintext passwords in the `password_hash` column.
-- This is insecure for production. Use the admin CSV import (which hashes passwords) or replace these with proper hashes.

INSERT INTO `users` (`username`,`name`,`email`,`password_hash`,`role`) VALUES
('student1','Student One','student@example.com','studentpass','student'),
('staff1','Dr. Sajida','staff@example.com','staffpass','staff'),
('admin','Admin User','admin@example.com','adminpass','admin');

INSERT INTO `courses` (`code`,`title`,`description`,`credits`) VALUES
('CS101','Introduction to Computer Science','Basics of computer science and programming.',3),
('CS102','Data Structures','Study of data structures and algorithms.',3),
('CS201','Database Systems','Relational databases and SQL.',3);

INSERT INTO `assignments` (`course_id`,`title`,`description`,`due_date`,`created_by`) VALUES
(1,'Assignment 1','Introductory programming assignment','2026-02-01 23:59:00',2),
(2,'Homework 1','Linked lists and stacks','2026-02-05 23:59:00',2);

-- Additional dummy users
INSERT INTO `users` (`username`,`name`,`email`,`password_hash`,`role`) VALUES
('student2','Student Two','student2@example.com','student2pass','student'),
('student3','Student Three','student3@example.com','student3pass','student'),
('student4','Student Four','student4@example.com','student4pass','student'),
('student5','Student Five','student5@example.com','student5pass','student'),
('staff2','Prof. Ahmed','staff2@example.com','staff2pass','staff');

-- Additional dummy courses
INSERT INTO `courses` (`code`,`title`,`description`,`credits`) VALUES
('CS301','Algorithms','Advanced algorithms and complexity analysis.',3),
('CS302','Operating Systems','Processes, threads, and concurrency.',3),
('CS303','Web Development','Frontend and backend web development.',3),
('CS304','Machine Learning','Introduction to ML concepts and tools.',3);

-- Additional dummy assignments (created_by uses staff1 id = 2)
INSERT INTO `assignments` (`course_id`,`title`,`description`,`due_date`,`created_by`) VALUES
(3,'DB Project','Design and implement a small database-driven app','2026-03-01 23:59:00',2),
(4,'Algorithm Analysis','Problem set on sorting and graphs','2026-02-15 23:59:00',2),
(5,'OS Lab','Experiment with process scheduling','2026-02-20 23:59:00',2),
(6,'Web App','Create a simple CRUD web application','2026-03-10 23:59:00',2),
(7,'ML Assignment','Implement basic classifiers','2026-03-20 23:59:00',2);

-- End of dump
