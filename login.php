<?php
// Establish a database connection
 $servername = 'localhost';
 $username = 'smriti';
 $password = 'Hellosmriti@8';
 $dbname = 'exampaper';

 $conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to validate the user
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $stored_password = $row["password"];

        // Verify the password using password_verify
        if (password_verify($password, $stored_password)) {
            // Password is correct
            echo "Login successful!";
        } else {
            // Password is incorrect
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}
$conn->close();
?>
