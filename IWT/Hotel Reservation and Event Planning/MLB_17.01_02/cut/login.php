<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
        $row  = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] =  $row['id'];
        header('location:index.html');
    }else{
        $message[] = 'Incorrect Email or Password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body >
    <section class="header">
    <div class="formContainer">
        <form enctype="multipart/form-data" action="" method="post">
            <h3>LOGIN NOW</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
            <input class="Box" required name="email" placeholder="Enter Email" type="email">
            <input class="Box" required name="password" placeholder="Enter Password" type="password">
            <input type="submit" name="submit" value="login now" class="Button">
            
            <p>NEW USER? <a href="register.php">REGISTER NOW</a></p>
        </form>
    </div>
        </section>
</body>
</html>