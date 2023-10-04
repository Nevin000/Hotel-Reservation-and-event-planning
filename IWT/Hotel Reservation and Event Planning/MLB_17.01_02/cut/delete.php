<?php

$con = new mysqli('localhost', 'root', '', 'hotel');

if(!$con){
    /*echo "Connection successful";*/
    die(mysqli_error($con));
}

if (isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM rate WHERE id = $id";

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
