<?php

$con = new mysqli('localhost', 'root', '', 'hotel');

if(!$con){
    /*echo "Connection successful";*/
    die(mysqli_error($con));
}

$id = $_GET['updateid'];

$sql = "SELECT * FROM rate WHERE id=$id";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

$name= $row['name'];
$title = $row['title'];
$message = $row['message'];
$rate = $row['rate'];

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $rate = $_POST['rate'];

    $sql = "UPDATE rate SET id=$id, name='$name', title='$title', message='$message', rate='$rate' WHERE id=$id ";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        /*echo "Data Updated Successfully";*/
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
    <title>CRUD operations - Contact Details</title>

</head>
<body>
<p class="topic">Review Update Form</p>

    <div class="review-box">

        <form method="post">
            <div class="section">
                <label>Name : </label>
                <input type="text" class="name" name="name" value="<?php echo $name; ?>">
            </div>
            <br>
            <div class="section">
                <label>Review Title : </label>
                <select name="title" id="title" class="title" required>
                    <option value="Wedding" <?php if ($title === 'Wedding') echo 'selected'; ?>>Wedding</option>
                    <option value="Party" <?php if ($title === 'Party') echo 'selected'; ?>>Party</option>
                    <option value="Meeting" <?php if ($title === 'Meeting') echo 'selected'; ?>>Meeting</option>
                    <option value="Conference" <?php if ($title === 'Conference') echo 'selected'; ?>>Conference</option>
                </select>
            </div>
            <br>
            <div class="section">
                <label>Review Message : </label>
                <br>
                <textarea cols="30" rows="10" class="Cmessage" name="message"><?php echo $message; ?>"</textarea>
            </div>
            <br>
            <div class="section-rate">
                <label>Rate : </label>
                <select name="rate" id="rate" class="rate" required>
                    <option value="1" <?php if ($rate === '1') echo 'selected'; ?>>⭐</option>
                    <option value="2" <?php if ($rate === '2') echo 'selected'; ?>>⭐⭐</option>
                    <option value="3" <?php if ($rate === '3') echo 'selected'; ?>>⭐⭐⭐</option>
                    <option value="4" <?php if ($rate === '4') echo 'selected'; ?>>⭐⭐⭐⭐</option>
                    <option value="5" <?php if ($rate === '5') echo 'selected'; ?>>⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <br>
            <button type="submit" class="btn" name="send">Update Review</button>
        </form>
    </div>



</body>
</html>