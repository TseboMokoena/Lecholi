<?php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $subject = "New Subscription";

        $to = "subscriptions@lecholi.co.ls";
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/html\r\n";

        $email_message = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Surname:</strong> $surname</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Gender:</strong> $gender</p>
            <p><strong>Country:</strong> $country</p>
            <br>
            <p>Excel friendly, copy and paste into excel table and format<p>
            <p>$name,$surname,$email,$gender,$country</p>
        </body>
        </html>
        ";

        if (mail($to, $subject, $email_message, $headers)) {
            echo "Success. Thank you!";
        } else {
            echo "Sorry, there was a problem when signing you up.";
        }
    }
?>
