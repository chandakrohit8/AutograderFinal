<!-- teacher_dashboard.php -->

<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $teacher_username = $_POST["teacher_username"];
        $teacher_password = $_POST["teacher_password"];

        // Perform authentication here, e.g. check credentials against database
        // If authentication is successful, redirect to teacher dashboard
        // You can also use a PHP framework for handling authentication, e.g. Laravel, CodeIgniter, etc.

        // Redirect to teacher dashboard
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
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
            color: #FCFCFD;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 30px;
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
        .success {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Welcome, Teacher!</h1>
    <h2>Teacher Dashboard</h2>
    <form action="upload_model_answers.php" method="post" enctype="multipart/form-data" class="container">
        <label for="subject_code">Subject Code:</label>
        <input type="text" id="subject_code" name="subject_code">
        <br>
        <label for="model_answers">Model Answers Sheet:</label>
        <input type="file" id="model_answers" name="model_answers">
        <br>
        <input type="submit" value="Upload">
    </form>
    
</body>
</html>

