<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn = mysqli_connect('localhost', 'web_app', 'hola', 'webapp_db') 
            or die("Mysql db connection failed");
        
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $messageBody = $_POST['message'];

            $sql = "INSERT INTO `messages` (`name`, `email`, `messageBody`) VALUES ('$name', '$email', '$messageBody');";

            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "Message Submitted";
            } else {
                echo "Message Submission Failed";
            }
        }
    }

?>