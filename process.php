<?php
setcookie('samesite', '1', 0, '/; samesite=strict');
if ($_POST['firstName'] != '' && $_POST['lastName'] != '' && $_POST['email'] != '' && $_POST['theme'] != '' && $_POST['message'] != '') {   

    $message = '
        <!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Youtube converter</title>
</head>
<body>
   ' . $table . '
   <h2>Youtube converter - Direct contact website</h2>
   <p>Name: '.$_POST["firstName"]. ' '. $_POST["lastName"]. '</p>
   <p>Email address: ' . $_POST["email"] . '</p>
   <p>Theme: ' . $_POST["theme"] . '</p>
   <p>Message: ' . $_POST["message"] . '</p><br>




   
   <span style="font-size:10px;color:#c6c6c6;">powered by <a href="https://www.fiverr.com/viktorshmatko"> viktorshmatko</span> 
   
</body>
</html>';
    // viktorshmatko11@gmail.com
    //469834223@qq.com
    $to .= "<469834223@qq.com>";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\nFrom: 469834223@qq.com\r\n";
    $subject = "Youtube converter - Direct contact website";
    mail($to, $subject, $message, $headers);
    // header('Location:index.php');
}
?>