<?php
// Initialize a session
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["role"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        // Establish a database connection
        $db_host = 'localhost';
        $db_user = 'smriti';
        $db_password = 'Hellosmriti@8';
        $db_name = 'exampaper';

        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate input
        if (empty($username) || empty($password)) {
            echo "Username and password are required.";
        } else {
            // Retrieve user information from the database
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user['password']) && $user['role'] === $role) {
                        // Valid user, set the user's role and redirect accordingly
                        $_SESSION['user_role'] = $user['role'];
                        if ($role === 'teacher') {
                            header("Location: teacher_dashboard.php");
                            exit();
                        } elseif ($role === 'student') {
                            header("Location: student_dashboard.php");
                            exit();
                        }
                    } else {
                        echo "Invalid credentials or role.";
                    }
                } else {
                    echo "User not found.";
                }
            } else {
                echo "Database error. Please try again later.";
            }
        }

        $stmt->close();
        $conn->close();
    }
}
?>


<!-- Rest of your HTML code as is -->


 <!DOCTYPE html>
<html>
<head>
    <title>Exam Paper Checking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #060039;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #0E0841;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #FCFCFD;
            font-size: 3rem;
        }
        h2 {
            margin-top: 30px;
            text-align: center;
            color: #FCFCFD;
            font-size: 1.9rem;
        }
        form {
            margin-top: 30px;
            color: #FCFCFD;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 30.9rem;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 30.9rem;
            font-size: 16px;
            font-weight: bold;
            margin-left: 0.6rem;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .register-div {
            display: flex;
            flex-direction: row;
        }
        .register-button{
        background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            margin-left: 0.6rem;
            transition: background-color 0.3s ease;
        }
        .drop-down {
           width: 30.9rem;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>Exam Paper Checking System</h1>
    <div class="container">

        <form action="" method="POST" id="loginForm">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="role">Role:</label>
        <select id="role" name="role" class="drop-down">
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>
    </div>
    <div class="register-div">
        <input type="submit" value="Login">

    </div>

</form>
  <div class="register-div">
            <input type="button" class="register-button" value="Register" onclick="redirectToRegister()">
        </div>
    </div>

    <script>
         function redirectToRegister() {
            window.location.href = "register.php";
        }
    </script>
</body>
</html>
