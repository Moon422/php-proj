<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Dashboard | Admin</title>
</head>
<body>

<?php

    echo $_SERVER["SUBMIT"];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn = mysqli_connect('localhost', 'web_app', 'hola', 'webapp_db') 
            or die("Mysql db connection failed");
        
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT `profileId` FROM `users` WHERE `username`='$username' AND `password`='$password';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $profileId = mysqli_fetch_assoc($result)["profileId"];
                
                $sql = "SELECT `firstName`, `lastName` FROM `profiles` WHERE `id`=$profileId;";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);

                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];

                    $fullName = $firstName." ".$lastName;

                    echo(
                        "
                            <nav class=\"navbar navbar-expand-lg bg-body-tertiary\">
                                <div class=\"container-fluid\">
                                    <a class=\"navbar-brand\" href=\"#\">Navbar</a>
                                    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                                    <span class=\"navbar-toggler-icon\"></span>
                                    </button>
                                    <div class=\"collapse navbar-collapse flex-row-reverse\" id=\"navbarSupportedContent\">
                                        Logged in as ".$fullName."
                                    </div>
                                </div>
                            </nav>
                        "
                    );

                    $sql = "SELECT `name`, `email`, `messageBody` FROM `messages`;";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo (
                        "
                            <div class=\"container\">
                                <table class=\"w-100\">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>");
                    
                        $row = mysqli_fetch_assoc($result);
                        while ($row) {
                            $senderName = $row["name"];
                            $senderEmail = $row["email"];
                            $message = $row["messageBody"];

                            echo("
                                <tr>
                                    <td>".$senderName."</td>".
                                    "<td>".$senderEmail."</td>".
                                    "<td>".$message."</td>".                                            
                                "</tr>"
                            );

                            $row = mysqli_fetch_assoc($result);
                        }

                        echo(
                            "</tbody>   
                                    </table>
                                </div>
                            "
                        );
                    }
                }
            }
        }
    }

?>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>