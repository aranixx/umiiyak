document.addEventListener("DOMContentLoaded", function () {
    function selectRole(role) {
        document.getElementById("role-selection").style.display = "none";

        document.getElementById("student-login-form").style.display = role === "Student" ? "block" : "none";
        document.getElementById("faculty-login-form").style.display = role === "Faculty" ? "block" : "none";
        document.getElementById("admin-login-form").style.display = role === "Admin" ? "block" : "none";
    }

    function showRegister(role) {
        document.getElementById("student-login-form").style.display = "none";
        document.getElementById("student-register-form").style.display = role === "Student" ? "block" : "none";

        document.getElementById("faculty-login-form").style.display = "none";
        document.getElementById("faculty-register-form").style.display = role === "Faculty" ? "block" : "none";

        document.getElementById("admin-login-form").style.display = "none";
    }

    function showLogin(role) {
        document.getElementById("student-register-form").style.display = "none";
        document.getElementById("student-login-form").style.display = role === "Student" ? "block" : "none";

        document.getElementById("faculty-register-form").style.display = "none";
        document.getElementById("faculty-login-form").style.display = role === "Faculty" ? "block" : "none";

        document.getElementById("admin-login-form").style.display = role === "Admin" ? "block" : "none";
    }

    function goBack() {
        document.getElementById("student-login-form").style.display = "none";
        document.getElementById("student-register-form").style.display = "none";
        document.getElementById("faculty-login-form").style.display = "none";
        document.getElementById("faculty-register-form").style.display = "none";
        document.getElementById("admin-login-form").style.display = "none";
        document.getElementById("role-selection").style.display = "block";
    }

    function isValidEmail(email) {
        return /^[^\s@]+@gmail\.com$/.test(email);
    }

    function isValidPassword(password) {
        return password.length >= 6;
    }

    function isValidStudentID(student_id) {
        return /^\d{6}$/.test(student_id);
    }

    function login(role) {
        let formData = new FormData();
        formData.append("role", role);

        if (role === "Student") {
            formData.append("student_id", document.getElementById("login-student_id").value.trim());
            formData.append("password", document.getElementById("login-student-password").value.trim());
        } else if (role === "Faculty") {
            formData.append("gcf_id", document.getElementById("login-gcf-id").value.trim());
            formData.append("password", document.getElementById("login-faculty-password").value.trim());
        } else if (role === "Admin") {
            formData.append("email", document.getElementById("login-admin-email").value.trim());
            formData.append("password", document.getElementById("login-admin-password").value.trim());
        }

        fetch("login.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            showMessage(data.message, data.success);
            if (data.success) {
                setTimeout(() => {
                    window.location.href = role.toLowerCase() + "_dashboard.php";
                }, 1500);
            }
        })
        .catch(error => showMessage("An error occurred.", false));
    }

    function register(role) {
        let formData = new FormData();
        formData.append("role", role);

        if (role === "Student") {
            formData.append("student_id", document.getElementById("register-student_id").value.trim());
            formData.append("email", document.getElementById("register-email").value.trim());
            formData.append("password", document.getElementById("register-password").value.trim());
        } else if (role === "Faculty") {
            formData.append("gcf_id", document.getElementById("register-gcf-id").value.trim()); // Fixed ID
            formData.append("first_name", document.getElementById("register-firstname").value.trim());
            formData.append("last_name", document.getElementById("register-lastname").value.trim());
            formData.append("email", document.getElementById("register-faculty-email").value.trim());
            formData.append("password", document.getElementById("register-faculty-password").value.trim());
        }

        fetch("register.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => showMessage(data.message, data.success))
        .catch(error => showMessage("An error occurred.", false));
    }

    function showMessage(message, success) {
        let messageBox = document.getElementById("message-box");
        messageBox.textContent = message;
        messageBox.style.color = success ? "green" : "red";
        messageBox.style.display = "block";

        setTimeout(() => {
            messageBox.style.display = "none";
        }, 3000);
    }

    window.selectRole = selectRole;
    window.showRegister = showRegister;
    window.showLogin = showLogin;
    window.goBack = goBack;
    window.login = login;
    window.register = register;
});
