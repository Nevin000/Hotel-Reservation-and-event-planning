<?php

$con = new mysqli('localhost', 'root', '', 'hotel');

if(!$con){
    die(mysqli_error($con));
}

if(isset($_POST['send'])){
    $name = $_POST['name'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO rate (name, title, message, rate) VALUES ('$name', '$title', '$message', '$rate')";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        header('location:read.php');
    }
    else{
        die(mysqli_error($con));
    }
}

?>



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="st.css">
    <title>Create</title>

    <style>

    </style>
</head>
<body>

<p class="topic">Review Form</p>
    <div class="review-box">
        <form method="post">
            <div class="section">
                <label>Name : </label>
                <input type="text" class="name" name="name">
            </div>
            <br>
            <div class="section">
                <label>Review Title : </label>
                <select name="title" id="title" class="title" required>
                    <option value="Wedding">Wedding</option>
                    <option value="Party">Party</option>
                    <option value="Meeting">Meeting</option>
                    <option value="Conference">Conference</option>
                </select>
            </div>
            <br>
            <div class="section">
                <label>Review Message : </label>
                <br>
                <textarea cols="30" rows="10" class="Cmessage" name="message"></textarea>
            </div>
            <br>
            <div class="section-rate">
                <label>Rate : </label>
                <select name="rate" id="rate" class="rate" required>
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn" name="send">Send Review</button>
        </form>
    </div>


</body>
</html>