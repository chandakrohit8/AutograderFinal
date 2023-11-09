<!-- student_dashboard.php -->

<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_roll_number = $_POST["student_roll_number"];
        $student_name = $_POST["student_name"];
        $student_subject_code = $_POST["student_subject_code"];

        // Perform authentication here, e.g. check credentials against database
        // If authentication is successful, redirect
    }

    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
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
            padding-right: 20px;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #FCFCFD;
        }
        h2 {
            margin-top: 30px;
            text-align: center;
            color: #FCFCFD;
        }
        form {
            max-width: 500px;

            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 30px;
            color: #FCFCFD;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="file"] {
            width: 29.6rem;
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
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome, Student!</h1>
    <h2>Student Dashboard</h2>
    <form action="upload_student_answers.php" method="post" enctype="multipart/form-data" class="container">
        <label for="subject_code">Subject Code:</label>
        <input type="text" id="subject_code" name="subject_code">
        <br>

        <label for="roll_number">Roll Number:</label>
        <input type="text" id="roll_number" name="roll_number">
        <br>
        <label for="student_name">Name:</label>
        <input type="text" id="student_name" name="student_name">
        <br>
        <label for="student_answers">Student Answers Sheet:</label>
        <input type="file" id="student_answers" name="student_answers">
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
