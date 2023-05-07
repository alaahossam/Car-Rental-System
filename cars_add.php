<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, "3307");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$_SESSION['conn'] = $conn;

$conn = $_SESSION['conn'];
?>


<!DOCTYPE HTML>
<html>

<head>
    <title>RENTIX</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
</head>

<body class="is-preload">
    <nav class="navbar navbar-custom" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="admin_dashboard.php">
                    RENTIX </a>
            </div>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="admin_dashboard.php">Home</a>
                    </li>
                    <li>
                        <a href="cars_information.php">Cars Informationn</a>
                    </li>
                    <li class="nav-link">
                        <a href="customers_info.php" class="nav-link">Customers Information</a>
                    </li>
                    <li>
                        <a href="reservations_info.php" class="nav-link">Reservations</a>
                    </li>
                    <li class="nav-link">
                        <a href="dailypayments.php" class="nav-link">Payments Reports</a>
                    </li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <div id="wrapper">

        <!-- Header -->
        <br>
        <br>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <div class="container">
                <h2>Register</h2>
                <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                    <form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="plateId" class="form-control" id="plateId" placeholder="Plate Id" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="Brand" class="form-control" id="Brand" placeholder="Brand" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="model" class="form-control" id="model" placeholder="Model" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="Type" class="form-control" id="Type" placeholder="Type" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="number" onkeypress="return event.charCode >= 48" min="1" name="year" class="form-control" id="year" placeholder="Year" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="color" class="form-control" id="color" placeholder="Color" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="number" onkeypress="return event.charCode >= 48" min="1" name="power" class="form-control" id="power" placeholder="Horse Power" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="number" onkeypress="return event.charCode >= 48" min="1" name="price" class="form-control" id="price" placeholder="Price" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <select name="automatic" id="automatic" required>
                                <option value="" disabled selected hidden>Automatic/Manual</option>
                                <option value="1">Automatic</option>
                                <option value="0">Manual</option>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <select name="office_id" id="office_id" required>
                                <option value="" disabled selected hidden>Location</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM `office` order by location ");
                                $office_idss=array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $office_idss[] =$row['office_id'];
                                }
                                foreach ($office_idss as $office_id) {
                                    $result = mysqli_query($conn, "SELECT * FROM `office` where office_id=$office_id");
                                    $row = mysqli_fetch_assoc($result);
                                    $office_ids="Location: ". $row['location'] ."||office: ".$row['office_name'];    
                                    echo "<option value=\"$office_id\">$office_ids</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="img">Image: </label>
                            <input type="file" accept="image/*" name="img" id="img" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary mb-2" value="Register" />
                    </form>
                </div>
            </div>
        </div>
    </footer>

    </div>
    <?php
    $conn = $_SESSION['conn'];

    if (isset($_POST['submit'])) {

        $plate_id = $_POST['plateId'];
        $model = $_POST['model'];
        $brand = $_POST['Brand'];
        $year = $_POST['year'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $Type = $_POST['Type'];
        $power = $_POST['power'];
        $isAutomatic = $_POST['automatic'];
        $office_id = $_POST['office_id'];
        $out_of_service = '0';

        $result = mysqli_query($conn, "SELECT * FROM `car` WHERE car_plate_id = '$plate_id'");
        $car = mysqli_fetch_assoc($result);

        if ($car) { // if car exists
            echo '<script>';
            echo 'alert("Car already exists!");';
            echo 'window.location = "cars_add.php"';
            echo '</script>';
        } else {
            $filename = $_FILES["img"]["name"];
            $tempname = $_FILES["img"]["tmp_name"];
            $folder =  "images/" . $filename;
            if (move_uploaded_file($tempname, $folder)) {
                $query = "INSERT INTO `car` (car_plate_id, brand_name , brand_model, year, out_of_service, price, color,Type, hourse_power, `automatic`,office_id, img) 
                    VALUES('$plate_id', '$brand','$model','$year','$out_of_service','$price','$color','$Type','$power','$isAutomatic','$office_id','$filename')";
                $result = mysqli_query($conn, $query);
                echo '<script>';
                echo 'alert("Car registered successfully");';
                echo '</script>';
                
                echo '<script>';
                echo 'window.location = "admin_dashboard.php"';
                echo '</script>';
                exit();
            } else {
                echo "<script>";
                echo "alert('Failed to upload the image !')";
                echo "</script>";

                echo '<script>';
                echo 'window.location = "cars_add.php"';
                echo '</script>';
            }
        }
    }
    $conn->close();
    ?>
</body>
</html>