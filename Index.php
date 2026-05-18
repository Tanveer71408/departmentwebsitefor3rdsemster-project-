<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Department Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- Main Website (Public View) -->
    <div id="publicWebsite">
        <!-- Header -->
        <header>
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <img src="Assets/Software dept logo .png" alt="logo">
                        <div class="logo-text">
                            <h1>DEPARTMENT OF SOFTWARE ENGINEERING </h1>
                            <p>QUAID-E-AWAM UNIVERSITY OF ENGINEERING,SCIENCE & TECHNOLOGY, NAWABSHAH </p>
                        </div>
                    </div>

                    <nav id="mainNav">
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#programs">Programs</a></li>
                            <li><a href="#faculty">Faculty</a></li>
                            <li><a href="#research">Research</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>

                    <div class="auth-buttons">
                        <a href="#" class="auth-btn login-btn" onclick="openLoginModal('staff')">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </div>

                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="container">
                <h2>DEPARTMENT OF SOFTWARE ENGINEERING</h2>
                <p>Access your personalized dashboard for students, faculty, and administration. Manage your academic
                    journey, research, and department activities all in one place.</p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                    <button class="btn btn-student" onclick="openLoginModal('student')">
                        <i class="fas fa-user-graduate"></i> Student Login
                    </button>
                    <button class="btn btn-staff" onclick="openLoginModal('staff')">
                        <i class="fas fa-chalkboard-teacher"></i> Staff Login
                    </button>
                    <button class="btn btn-admin" onclick="openLoginModal('admin')">
                        <i class="fas fa-user-cog"></i> Admin Login
                    </button>
                </div>
            </div>
        </section>

        <!-- Login Options Section -->
        <section class="login-options" id="loginOptions">
            <div class="container">
                <div class="section-title">
                    <h2>Department Portal Access</h2>
                    <p>Select your role to access the department management system</p>
                </div>

                <div class="login-cards">
                    <div class="login-card student">
                        <div class="login-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>Student Portal</h3>
                        <p>Access your courses, grades, assignments, academic calendar, and department announcements.
                        </p>
                        <button class="btn btn-student" onclick="openLoginModal('student')">
                            Student Login
                        </button>
                    </div>

                    <div class="login-card staff">
                        <div class="login-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>Staff Portal</h3>
                        <p>Manage courses, upload materials, grade assignments, track attendance, and communicate with
                            students.</p>
                        <button class="btn btn-staff" onclick="openLoginModal('staff')">
                            Staff Login
                        </button>
                    </div>

                    <div class="login-card admin">
                        <div class="login-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h3>Admin Portal</h3>
                        <p>Manage department operations, user accounts, course schedules, and generate reports.</p>
                        <button class="btn btn-admin" onclick="openLoginModal('admin')">
                            Admin Login
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <div class="section-title">
                    <h2>Department Management Features</h2>
                    <p>Comprehensive tools for efficient department administration and academic management</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Academic Calendar</h3>
                        <p>Manage schedules, deadlines, exams, and department events</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>Course Management</h3>
                        <p>Create, modify, and manage course offerings and materials</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Analytics & Reports</h3>
                        <p>Generate detailed reports on academic performance and department metrics</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Communication Hub</h3>
                        <p>Internal messaging, announcements, and notification system</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-content">
                    <div class="footer-column">
                        <h4>DEPARTMENT OF SOFTWARE ENGINEERING</h4>
                        <p>QUAID-E-AWAM UNIVERSITY Engineering, Science , Technology<br>123 University
                            Drive<br>NAWABSHAH, Pakistan</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <div class="footer-column">
                        <h4>Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About Us</a></li>
                            <li><a href="#programs">Programs</a></li>
                            <li><a href="#loginOptions">Login Portal</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h4>Student Resources</h4>
                        <ul class="footer-links">
                            <li><a href="#">Course Catalog</a></li>
                            <li><a href="#">Academic Calendar</a></li>
                            <li><a href="#">Assignment Portal</a></li>
                            <li><a href="#">Grade Reports</a></li>
                            <li><a href="#">Department Library</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h4>Staff Resources</h4>
                        <ul class="footer-links">
                            <li><a href="#">Course Management</a></li>
                            <li><a href="#">Grade Submission</a></li>
                            <li><a href="#">Attendance Tracking</a></li>
                            <li><a href="#">Research Portal</a></li>
                            <li><a href="#">Department Policies</a></li>
                        </ul>
                    </div>
                </div>

                <div class="copyright">
                    <p>&copy; Department of Software Engineering, QUAID-E-AWAM UNIVERSITY OF ENGINEERING,SCIENCE &
                        TECHNOLOGY, NAWABSHAH. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Login Modal -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeLoginModal()">&times;</span>
            <h2 id="modalTitle">Student Login</h2>
            <form id="loginForm" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="username">Username/Email</label>
                    <input type="text" id="username" name="username" required
                        placeholder="Enter your username or email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>

                <div class="form-group">
                    <label for="role">Login As</label>
                    <select id="role" name="role" required>
                        <option value="student">Student</option>
                        <option value="staff">Faculty/Staff</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn submit-btn" id="loginSubmitBtn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <div class="login-footer">
                    <p>Need help? Contact department support at <strong>support@038</strong></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Dashboard Views (Hidden by default) -->

    <!-- Student Dashboard -->
    <div id="studentDashboard" class="dashboard" style="display: none;">
        <div class="dashboard-header">
            <div class="container">
                <div class="dashboard-nav">
                    <div class="logo">
                        <i class="fas fa-university"></i>
                        <div class="logo-text">
                            <h1 style="color: white;">Student Portal</h1>
                            <p style="color: white;">Department OF SOFTWARE ENGINEERING</p>
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h4 style="color: white;">John Doe</h4>
                            <p>Tanveer Arain | B.E Software Engineering</p>
                        </div>
                        <a href="#" class="logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-book"></i> My Courses</a></li>
                    <li><a href="#"><i class="fas fa-tasks"></i> Assignments</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Grades</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i> Schedule</a></li>
                    <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Fees & Payments</a></li>
                    <li><a href="#"><i class="fas fa-bullhorn"></i> Announcements</a></li>
                    <li><a href="#"><i class="fas fa-user-edit"></i> Profile Settings</a></li>
                </ul>
            </div>

            <div class="main-content">
                <div class="dashboard-title">
                    <h2>Student Dashboard</h2>
                    <p>Welcome back, Tanveer! Here's your academic overview.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-book-open"></i>
                        <span class="stat-number">5</span>
                        <span class="stat-label">Current Courses</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-tasks"></i>
                        <span class="stat-number">3</span>
                        <span class="stat-label">Pending Assignments</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-chart-line"></i>
                        <span class="stat-number">3.8</span>
                        <span class="stat-label">Current GPA</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-calendar-day"></i>
                        <span class="stat-number">7</span>
                        <span class="stat-label">Days to Next Exam</span>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <i class="fas fa-download"></i>
                        <span>Download Materials</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Submit Assignment</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-calendar-check"></i>
                        <span>View Schedule</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-question-circle"></i>
                        <span>Request Support</span>
                    </a>
                </div>

                <div class="recent-activity">
                    <h3>Recent Activity</h3>
                    <ul class="activity-list">
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div>
                                <strong>New material uploaded</strong> in Data Structures course
                                <p>2 hours ago</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div>
                                <strong>Assignment deadline</strong> for Algorithms course
                                <p>Due in 6 days</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div>
                                <strong>Department announcement:</strong> Workshop on DBS
                                <p>10 JAN</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff Dashboard -->
    <div id="staffDashboard" class="dashboard" style="display: none;">
        <div class="dashboard-header">
            <div class="container">
                <div class="dashboard-nav">
                    <div class="logo">
                        <i class="fas fa-university"></i>
                        <div class="logo-text">
                            <h1 style="color: white;">Faculty Portal</h1>
                            <p style="color: white;">software engineering Department</p>
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <h4 style="color: white;">Dr. sajida parveen</h4>
                            <p> ASS0CATE Professor | SOFTWARE ENGINEERING</p>
                        </div>
                        <a href="#" class="logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-book"></i> My Courses</a></li>
                    <li><a href="#"><i class="fas fa-user-graduate"></i> Students</a></li>
                    <li><a href="#"><i class="fas fa-tasks"></i> Assignments</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Gradebook</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i> Schedule</a></li>
                    <li><a href="#"><i class="fas fa-flask"></i> Research</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> Department Tools</a></li>
                </ul>
            </div>

            <div class="main-content">
                <div class="dashboard-title">
                    <h2>Faculty Dashboard</h2>
                    <p>Welcome, Dr.sajida parveen. Manage your courses and research activities.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-book-open"></i>
                        <span class="stat-number">3</span>
                        <span class="stat-label">Courses Teaching</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-user-graduate"></i>
                        <span class="stat-number">120</span>
                        <span class="stat-label">Total Students</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-tasks"></i>
                        <span class="stat-number">45</span>
                        <span class="stat-label">Assignments to Grade</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-file-alt"></i>
                        <span class="stat-number">2</span>
                        <span class="stat-label">Research Papers</span>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Upload Lecture</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-check-circle"></i>
                        <span>Grade Assignments</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Schedule Office Hours</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-users"></i>
                        <span>Student Attendance</span>
                    </a>
                </div>

                <div class="recent-activity">
                    <h3>Upcoming Deadlines</h3>
                    <ul class="activity-list">
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div>
                                <strong>Grade submissions due</strong> for CS101 Midterm
                                <p>Due in 2 days</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <strong>Department meeting</strong> - Curriculum review
                                <p>Tomorrow, 10:00 AM</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div>
                                <strong>Research grant proposal</strong> submission
                                <p>Due in 7 days</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Dashboard -->
    <div id="adminDashboard" class="dashboard" style="display: none;">
        <div class="dashboard-header">
            <div class="container">
                <div class="dashboard-nav">
                    <div class="logo">
                        <i class="fas fa-university"></i>
                        <div class="logo-text">
                            <h1 style="color: white;">Admin Portal</h1>
                            <p style="color: white;">Department of software Engineering</p>
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div>
                            <h4 style="color: white;">Admin User</h4>
                            <p>Department Administrator</p>
                        </div>
                        <a href="#" class="logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> User Management</a></li>
                    <li><a href="#"><i class="fas fa-book"></i> Course Management</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i> Academic Calendar</a></li>
                    <li><a href="#"><i class="fas fa-chart-bar"></i> Analytics & Reports</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> System Settings</a></li>
                    <li><a href="#"><i class="fas fa-building"></i> Department Resources</a></li>
                    <li><a href="#"><i class="fas fa-file-contract"></i> Policies & Compliance</a></li>
                </ul>
            </div>

            <div class="main-content">
                <div class="dashboard-title">
                    <h2>Administrator Dashboard</h2>
                    <p>Department management and administration controls</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <span class="stat-number">1,250</span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-book"></i>
                        <span class="stat-number">45</span>
                        <span class="stat-label">Active Courses</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-user-tie"></i>
                        <span class="stat-number">65</span>
                        <span class="stat-label">Faculty Members</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="stat-number">12</span>
                        <span class="stat-label">Pending Requests</span>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Add New User</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-book-medical"></i>
                        <span>Create Course</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-file-export"></i>
                        <span>Generate Reports</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-cog"></i>
                        <span>System Settings</span>
                    </a>
                </div>

                <div class="recent-activity">
                    <h3>System Alerts & Notifications</h3>
                    <ul class="activity-list">
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <strong>System maintenance</strong> scheduled for Sunday
                                <p>2 hours downtime expected</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div>
                                <strong>5 new student registrations</strong> pending approval
                                <p>Requires admin review</p>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-server"></i>
                            </div>
                            <div>
                                <strong>Storage usage at 85%</strong> - Consider cleanup
                                <p>System performance may be affected</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="JS/javascript.js"></script>
</html> 