<?php
// Database configuration
$host = 'localhost';
$dbName = 'last';
$username = 'root';
$password = '';

// Create a connection
try {
    $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form action is for updating or deleting
    if (isset($_POST['update'])) {
        // Prepare the SQL statement to update a selection
        $stmt = $db->prepare("UPDATE hope SET hotel = :hotel, event = :event, adultnum = :adultnum, childnum = :childnum, nation = :nation WHERE id = :id");
        
        // Bind the form values to the prepared statement parameters
        $stmt->bindParam(':id', $_POST['id']); // Assuming 'id' is the name of the input field containing the ID
        
        $stmt->bindParam(':hotel', $_POST['hotel']);
        $stmt->bindParam(':event', $_POST['event']);
        $stmt->bindParam(':adultnum', $_POST['adultnum']); // Fixed parameter name
        $stmt->bindParam(':childnum', $_POST['childnum']); // Fixed parameter name
        $stmt->bindParam(':nation', $_POST['nation']); // Fixed parameter name
    
        // Execute the statement
        try {
            $stmt->execute();
            echo "Selection updated successfully!";
            header('location:res.php');
            exit(); // Added exit() to terminate the script after redirection
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }elseif (isset($_POST['delete'])) {
        // Prepare the SQL statement to delete a selection
        $stmt = $db->prepare("DELETE FROM hope WHERE id = :id");
        $stmt->bindParam(':id', $_POST['delete']);
        // Execute the statement
        try {
            $stmt->execute();
            echo "Selection deleted successfully!";
            header('location:res.php');
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

// Read selections from the table
$selectStmt = $db->query("SELECT * FROM hope");
$selections = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="/">EVENTS</a></li>
                    <li><a href="/">OFFERS</a></li>
                    <li><a href="galary3.html">ABOUT US</a></li>
                    <li><a href="galary2.html">FAQ</a></li>
                    <li><a href="galery.html">GALLERY</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="MenuShow()"></i>
        </nav>
        <div class="text_box">
            <p id="Stay">REVIEW YOUR EVENT</p>
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

<section>
    <div class="hotel">
    <h3>EXISTING SELECTIONS</h3>
    <table id="put">
        <tr >
            <th class="set">ID</th>
            <th class="set">Hotel</th>
            <th class="set">Event Type</th>
            <th class="set">Adults</th>
            <th class="set">Children</th>
            <th class="set">Nationality</th>
            <th class="set">Actions</th>
            </tr>
<?php foreach ($selections as $selection) {
    $hotel = $selection['hotel'];
    $event = $selection['event'];
    $adultnum = $selection['adultnum'];
    $childnum = $selection['childnum'];
    $nation = $selection['nation'];

    // Mapping the numbers to corresponding names
    $hotelName = "";
    if ($hotel == 1) {
        $hotelName = "NEVADA";
    } elseif ($hotel == 2) {
        $hotelName = "BEACH FRONT";
    } elseif ($hotel == 3) {
        $hotelName = "DENPASAR";
    }

    $eventName = "";
    if ($event == 1) {
        $eventName = "WEDDING";
    } elseif ($event == 2) {
        $eventName = "PARTY";
    } elseif ($event == 3) {
        $eventName = "CONFERENCE";
    } elseif ($event == 4) {
        $eventName = "MEETING";
    }

    $adultsName = "";
    if ($adultnum == 1) {
        $adultsName = "LESS THAN 10";
    } elseif ($adultnum == 2) {
        $adultsName = "LESS THAN 100";
    } elseif ($adultnum == 3) {
        $adultsName = "MORE THAN 100";
    }

    $childrenName = "";
    if ($childnum == 1) {
        $childrenName = "LESS THAN 10";
    } elseif ($childnum == 2) {
        $childrenName = "LESS THAN 100";
    } elseif ($childnum == 3) {
        $childrenName = "MORE THAN 100";
    }

    $nationName = "";
    if ($nation == 1) {
        $nationName = "RESIDENT";
    } elseif ($nation == 2) {
        $nationName = "NON_RESIDENT";
    }

    ?>
    <tr>
        <td><?php echo $selection['id']; ?></td>
        <td><?php echo $hotelName; ?></td>
        <td><?php echo $eventName; ?></td>
        <td><?php echo $adultsName; ?></td>
        <td><?php echo $childrenName; ?></td>
        <td><?php echo $nationName; ?></td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="update" value="<?php echo $selection['id']; ?>">
                <input type="submit" value="Update">
            </form>
            <form action="" method="post">
                <input type="hidden" name="delete" value="<?php echo $selection['id']; ?>">
                <input type="submit" value="Delete">
            </form>
        </td>
    </tr>
        <?php } ?>
    </table>
    </div>
</section>

<section>
    <div class="Row">
        <a href="payment page 1.html">PROCEED TO PAYMENT</a>
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
