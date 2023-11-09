<?php
    // File upload and processing logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Database connection
        $db_host = 'localhost';
        $db_user = 'smriti';
        $db_password = 'Hellosmriti@8';
        $db_name = 'exampaper';

        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get form data
        $subject_code = $_POST['subject_code'];

        // Upload model answers sheet
        $target_dir = "uploads/";
        $file_name = $subject_code . "_model_answers.pdf"; // Use subject code as file name
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["model_answers"]["tmp_name"], $target_file);

        // Save model answers file details to database
        $sql = "INSERT INTO model_answers (subject_code, file_name, file_path) VALUES ('$subject_code', '$file_name', '$target_file')";
        if (mysqli_query($conn, $sql)) {
            echo "<h1>File Uploaded Successfully</h1>";
            
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }

        // Close database connection
        mysqli_close($conn);
    }
?>

