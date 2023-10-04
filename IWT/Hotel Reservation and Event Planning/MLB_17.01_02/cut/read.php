<?php

$con = new mysqli('localhost', 'root', '', 'hotel');

if(!$con){
    /*echo "Connection successful";*/
    die(mysqli_error($con));
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="read.css">
    <title>Review Details</title>

</head>
<body>

<p class="topic">Review Details</p>
<div class="container">
    <button class="btn"><a href="create.php">New Review</a></button>
    <br>
    <br>
    <div class="review-table">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Review Id</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Message</th>
                <th scope="col">Rate</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $sql = "SELECT * FROM rate";

                $result = mysqli_query($con, $sql);

                if($result)
                {

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id = $row['id'];
                        $name = $row['name'];
                        $title = $row['title'];
                        $message = $row['message'];
                        $rate = $row['rate'];

                        echo '
                        
                        <tr>
                                <td>'. $id.'</td>
                                <td>'. $name.'</td>
                                <td>'. $title .'</td>
                                <td>'. $message .'</td>
                                <td>'. $rate .'</td>
                                <td>
                                    <button><a href="update.php?updateid='.$id.' " style="text-decoration: none;  color: black; font-style: italic; ">Update</a></button>
                                </td>
                                <td>
                                    <button><a href="delete.php?deleteid='.$id.' " style="text-decoration: none;  color: red; font-style: italic;">Delete</a></button>
                                </td>   
                        </tr>
                        
                        ';
                    }
                }
            ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
