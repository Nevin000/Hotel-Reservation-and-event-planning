<?php
// Database configuration
$host = 'localhost';
$dbName = 'last';
$username = 'root';
$password = '';

// Create a connection
$db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);


// Function to sanitize user inputs
function sanitize_input($input) {
    global $db;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = $db->quote($input); // Prevent SQL injection
    return $input;
}

// Function to handle form submission
function handle_form_submission() {
    global $db;

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $hotel = sanitize_input($_POST['hotel']);
        $event = sanitize_input($_POST['event']);
        $adultnum = sanitize_input($_POST['adultnum']);
        $childnum = sanitize_input($_POST['childnum']);
        $nation = sanitize_input($_POST['nation']);

        // Insert data into the database
        $query = "INSERT INTO hope (hotel, event, adultnum, childnum, nation) VALUES ($hotel, $event, $adultnum, $childnum, $nation)";
        $stmt = $db->prepare($query);
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "Data inserted successfully!";
            header('location:resres.php');
        } else {
            // Error occurred while inserting data
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}

// Call the function to handle form submission
handle_form_submission();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel | PHOENIX</title>
    <link rel="stylesheet" href="res.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="images/Black Elegant Phoenix Logo.png" alt="Phoenix Hotels Logo"></a>
            <div class="nav_links" id="navLinks">
                <i class="fa fa-times" onclick="MenuHide()"></i>
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="http://localhost/project/login.php">LOGIN</a></li>
                    <li><a href="http://localhost/cut/res.php">EVENTS</a></li>
                    <li><a href="/">OFFERS</a></li>
                    <li><a href="galary3.html">ABOUT US</a></li>
                    <li><a href="galary2.html">FAQ</a></li>
                    <li><a href="galery.html">GALLERY</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="MenuShow()"></i>
        </nav>
        <div class="text_box">
            <p id="Stay">BOOK YOUR STAY</p>
        </div>
    </section>

<!---HOTEL----->

<section class="hotel">
    <h1>PHOENIX HOTELS</h1>
    <h2>LOCATIONS</h2>
    <div class="Row">
        <div class="HColomn">
            <img width="300px" src="images/1.png">
            <div class="Layer">
                <h3>NEGARA(1)</h3>
            </div>
        </div>
        <div class="HColomn">
            <img width="300px" src="images/2.png">
            <div class="Layer">
                <h3>BEACH FRONT(2)</h3>
            </div>
        </div>
        <div class="HColomn">
            <img width="300px" src="images/3.png">
            <div class="Layer">
                <h3>DENPASAR(3)</h3>
            </div>
        </div>
    </div>
</section>

<!---EVENT----->

<section class="hotel">
    <h1>PHOENIX HOTELS</h1>
    <h2>EVENT TYPES</h2>
    <div class="Row">
        <div class="HColomn">
            <img width="300px" src="imagesH/wwwe.png">
            <div class="Layer">
                <h3>WEDDING(1)</h3>
            </div>
        </div>
        <div class="HColomn">
            <img width="300px" src="imagesH/wwws.png">
            <div class="Layer">
                <h3>CONFERENCE(2)</h3>
            </div>
        </div>
        <div class="HColomn">
            <img width="300px" src="imagesH/wwwr.png">
            <div class="Layer">
                <h3>PARTY(3)</h3>
            </div>
        </div>
        <div class="HColomn">
            <img width="300px" src="imagesH/wwwt.png">
            <div class="Layer">
                <h3>MEETINGS(4)</h3>
            </div>
        </div>
    </div>
</section>

<!---SELECTION----->
<section>
    <div class="hotel">
        <h3>SELECT EVENT TYPE</h3>

        <form action="" enctype="multipart/form-data" method="post">
            <label for="hotel">CHOOSE A HOTEL:</label>
            <select id="hotel" name="hotel" class="HColomn">
                <option value="1">NEVADA</option>
                <option value="2">BEACH FRONT</option>
                <option value="3">DENPASAR</option>
            </select>
            <label for="event">CHOOSE EVENT TYPE:</label>
            <select id="event" name="event" class="HColomn" required>
                <option value="1">WEDDING</option>
                <option value="2">PARTY</option>
                <option value="3">CONFERENCE</option>
                <option value="3">MEETING</option>
            </select>
            <label for="adultnum">ADULTS:</label>
            <select id="adultnum" name="adultnum" class="HColomn" required>
                <option value="1">LESS THAN 10</option>
                <option value="2">LESS THAN 100</option>
                <option value="3">MORE THAN 100</option>
            </select>
            <label for="childnum">CHILDRENS:</label>
            <select id="childnum" name="childnum" class="HColomn" required>
                <option value="1">LESS THAN 10</option>
                <option value="2">LESS THAN 100</option>
                <option value="3">MORE THAN 100</option>
            </select>
            <label for="nation">NATIONALITY:</label>
            <select id="nation" name="nation" class="HColomn" required>
                <option value="1">RESIDENT</option>
                <option value="2">NON_RESIDENT</option>
            </select>
            <input type="submit" class="Button"> 
        </form>
    </div>
</section>

<!---FOOTER----->

<section class="Footer">
    <div class="col1">
        <h3>USEFUL LINKS</h3>
        <a href="">ABOUT</a>
        <a href="">EVENTS</a>
        <a href="">GALLERY</a>
        <a href="">FAQ</a>
        <a href="">CONTACT US</a>
    </div>
    <div class="col2">
        <h3>NEWSLETTER</h3>
        <form>
            <input type="email" required placeholder="kavirumahim@gmail.com">
            <br>
            <button type="submit">SUBSCRIBE NOW</button>
        </form>
    </div>
    <div class="col3">
        <h3>CONTACT</h3>
        <p>XXX <br> XXX<br>XXX<br>XXX</p>
        <div class="Icons">
            <i class="fa fa-facebook" ></i>
            <i class="fa fa-twitter" ></i>
            <i class="fa fa-instagram" ></i>
            <i class="fa fa-linkedin" ></i>
        </div>
    </div>
</section>
    <script src="res.js"></script>
</body>
</html>