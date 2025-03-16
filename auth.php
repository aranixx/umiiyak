<?php 
session_start();
include('./db_connect.php');

// Fetch system settings only if they are not already set
if (!isset($_SESSION['system'])) {
    $system = $conn->query("SELECT * FROM system_settings")->fetch_assoc();
    $_SESSION['system'] = $system;
}

// Redirect if user is already logged in
if (isset($_SESSION['login_id'])) {
    header("Location: index.php?page=home");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <div class="school-header">
                <img src="image/logo1.png" alt="School Logo" class="school-logo">
                <div class="school-name">
                    <h3>Granby Colleges of Science and Technology</h3>
                    <h4>College of Informatics</h4>
                </div>
            </div>
            <h2 class="welcome-text">WELCOME STUDENTS AND FACULTY!</h2> 
        </div>

        <div class="form-section">
            <h2 class="form-title">GRANBY COI FACULTY EVALUATION</h2>

            <!-- Role Selection -->
            <div id="role-selection">
                <img src="image/logo1.png" alt="School Logo" class="school-logo role-logo">
                <h2 class="form-label">Login as:</h2>
                
                <div class="custom-dropdown">
                    <select id="role-select" class="role-dropdown" onchange="selectRole(this.value)" required>
                        <option value="" disabled selected hidden>Select your role</option>
                        <option value="Student">Student</option>
                        <option value="Faculty">Faculty</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>                
            </div>

            <!-- Student Login -->
            <div id="student-login-form" style="display: none;">
                <h3 class="form-label">Student Login</h3>
                <input type="text" id="login-student_id" placeholder="Enter your Student ID" required>
                <input type="password" id="login-student-password" placeholder="Password" required>
                <button onclick="login('Student')">Login</button>
                <p class="switch" onclick="showRegister('Student')">Don't have an account? <a href="#">Create an account</a></p>
                <p class="back-link" onclick="goBack()">Back</p>
            </div>

            <!-- Student Registration -->
            <div id="student-register-form" style="display: none;">
                <h3 class="form-label">Student Registration</h3>
                <input type="text" id="register-student_id" placeholder="Student ID" required>
                <input type="email" id="register-student-email" placeholder="Email" required>
                <input type="password" id="register-student-password" placeholder="Password" required>
                <button onclick="register('Student')">Create Account</button>                
                <p class="switch" onclick="showLogin('Student')">Already have an account? <a href="#">Sign In</a></p>
                <p class="back-link" onclick="goBack()">Back</p>
            </div>

            <!-- Faculty Login -->
            <div id="faculty-login-form" style="display: none;">
                <h3 class="form-label">Faculty Login</h3>
                <input type="text" id="login-gcf-id" placeholder="Enter your GCF User ID" required>
                <input type="email" id="login-faculty-email" placeholder="Enter your Email" required>
                <input type="password" id="login-faculty-password" placeholder="Password" required>
                <p id="faculty-login-error" class="error"></p>
                <button onclick="login('Faculty')">Login</button>
                <p class="switch" onclick="showRegister('Faculty')">Don't have an account? <a href="#">Create an account</a></p>
                <p class="back-link" onclick="goBack()">Back</p>
            </div>

            <!-- Faculty Registration -->
            <div id="faculty-register-form" style="display: none;">
                <h3 class="form-label">Faculty Registration</h3>
                <input type="text" id="register-gcf_id" placeholder="GCF ID" required>
                <div class="name-fields">
                    <input type="text" id="register-first_name" placeholder="First Name" required>
                    <input type="text" id="register-last_name" placeholder="Last Name" required>
                </div>
                <input type="email" id="register-faculty-email" placeholder="Email" required>
                <input type="password" id="register-faculty-password" placeholder="Password" required>
                <p id="faculty-register-error" class="error"></p>
                <button onclick="register('Faculty')">Create Account</button>
                <p class="switch" onclick="showLogin('Faculty')">Already have an account? <a href="#">Sign In</a></p>
                <p class="back-link" onclick="goBack()">Back</p>
            </div>

            <!-- Admin Login -->
            <div id="admin-login-form" style="display: none;">
                <h3 class="form-label">Admin Login</h3>
                <input type="email" id="login-admin-email" placeholder="Enter your Email" required>
                <input type="password" id="login-admin-password" placeholder="Password" required>
                <p id="admin-login-error" class="error"></p>
                <button onclick="login('Admin')">Login</button>
                <p class="back-link" onclick="goBack()">Back</p>
            </div>

            <script>
                function goBack() {
                    document.getElementById('student-login-form').style.display = 'none';
                    document.getElementById('student-register-form').style.display = 'none';
                    document.getElementById('faculty-login-form').style.display = 'none';
                    document.getElementById('faculty-register-form').style.display = 'none';
                    document.getElementById('admin-login-form').style.display = 'none';
                    document.getElementById('role-selection').style.display = 'block';
                }
            </script>

        <script src="script.js"></script>
    </body>
</html>
