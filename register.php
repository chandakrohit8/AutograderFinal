//
//
// <?php
// // Check if the form was submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if the required fields are set
//     if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["role"])) {
//         // Get user input
//         $username = $_POST["username"];
//         $password = $_POST["password"];
//         $role = $_POST["role"];
//
//         // Establish a database connection
//         $db_host = 'localhost';
//         $db_user = 'smriti';
//         $db_password = 'Hellosmriti@8';
//         $db_name = 'exampaper';
//
//         $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
//
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }
//
//         // Hash the password before storing it in the database
//         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//
//         // Insert user data into the database
//         $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
//         $stmt = $conn->prepare($sql);
//
//         if ($stmt) {
//             $stmt->bind_param("sss", $username, $hashed_password, $role);
//
//             if ($stmt->execute()) {
//                 // Redirect to a success page or login page
//                 header("Location: front.php");
//                 exit(); // Ensure no further output is sent
//             } else {
//                 // Handle the SQL error
//                 die("SQL Error: " . $stmt->error);
//                 echo "Registration failed. Please try again.";
//             }
//
//             $stmt->close();
//         } else {
//             // Handle the SQL statement preparation error
//             die("SQL Error: " . $conn->error);
//              echo "Database error. Please try again later.";
//         }
//
//         $conn->close();
//     } else {
//         echo "Required fields are not set.";
//
//     }
// }
// ?>
//

<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["role"])) {
        // Get user input
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
            // Check if the username is already registered
            $check_query = "SELECT * FROM users WHERE username = ?";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                echo "Username is already taken. Choose a different username.";
            } else {
                // Hash the password before storing it in the database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $insert_query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
                $insert_stmt = $conn->prepare($insert_query);

                if ($insert_stmt) {
                    $insert_stmt->bind_param("sss", $username, $hashed_password, $role);

                    if ($insert_stmt->execute()) {
                        // Registration successful
                        header("Location: front.php");
                        exit();
                    } else {
                        echo "Registration failed. Please try again.";
                    }

                    $insert_stmt->close();
                } else {
                    echo "Database error. Please try again later.";
                }
            }
        }

        $conn->close();
    } else {
        echo "Required fields are not set.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #060039; /* Dark blue background */
            color: #ECF0F1;
            text-align: center;
            padding: 50px;
        }

        .container {
            background-color:#0E0841; /* Dark blue container */
            border-radius: 10px;
            margin: 0 auto;
            padding: 20px;
            width: 400px;
            height: 450px;
        }

        h1 {
            color: #FCFCFD; /* Blue heading text */
        }

        label {
            display: block;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 300px;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007bff; /* Blue submit button */
            color: #ECF0F1;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 300px;
            margin-top: 25px;
        }

        input[type="submit"]:hover {
            background-color: #2980B9; /* Darker blue on hover */
        }

        .drop-down {
            width: 300px;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 3px;
        }

        .select {
            width: 300px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registration</h1>
        <form action="register.php" method="POST">
 <label for="username">Username:</label>
<input type="text" id="username" name="username" required autocomplete="username">

<label for="password">Password:</label>
<input type="password" id="password" name="password" required  autocomplete="current-password">


            <label for="role">Select a Role:</label>
            <select id="role" name="role" class="drop-down">
                <option value="student" class="select">Student</option>
                <option value="teacher" class="select">Teacher</option>
            </select>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>


