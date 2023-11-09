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
        $roll_number = $_POST['roll_number'];
        // $student_name = $_POST['student_name'];

        // Upload student answers sheet
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["student_answers"]["name"]);
        move_uploaded_file($_FILES["student_answers"]["tmp_name"], $target_file);

        // Run Python code and capture output
        $tar = "uploads/";
        $file_name = $subject_code . "_model_answers.pdf"; // Use subject code as file name
        $tart = $tar . $file_name;
        $model_answers_path = $tart; // Update with actual file path
        $student_answers_path = $target_file; // Use uploaded file path
        $model_answers_text = '...'; // Update with extracted text from model answers sheet
        $student_answers_text = '...'; // Update with extracted text from student answers sheet

        // Call Python script with arguments and capture output
        
        
        exec("C:/wamp64/www/autograder/hello.py $model_answers_path $student_answers_path", $output);
     // exec("C:/wamp64/www/autograder/process_answers.py $model_answers_path $student_answers_path", $output);
    //    $command_exec = escapeshellcmd('C:/wamp64/www/autograder/hello.py');
    //    $str_output = shell_exec($command_exec);
    //    echo $str_output;
        
        // Save student answers and Python code output to database
        $sql = "INSERT INTO student_answers (subject_code, student_name, roll_no) VALUES ('$subject_code', 'Sushmita', '$roll_number')";
        if (mysqli_query($conn, $sql)) {
            // Redirect back to student dashboard
            
            echo "<h1>Evaluation of your Answer paper</h1>";
            // $myfile = fopen("output.txt", "r") or die("Unable to open file!");
            // echo fread($myfile,filesize("output.txt"));
            // fclose($myfile);
             
            $homepage = file_get_contents('output.txt');
            echo '<PRE>' . $homepage . '</PRE>';

        //  $output_string = implode("\n", $output);
        //     echo $output_string;
            
           
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
    }
    
?>
