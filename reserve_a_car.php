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
                            <input type="text" name="ssn" class="form-control" id="ssn" placeholder="ssn" required>
                        </div>
                        <br>
                        <div class="form-group mx-sm-3 mb-2">
									<label for="pick_up_date">Pickup date</label>
									<input type="date" name="pick_up_date" class="form-control" id="pick_up_date" placeholder="Pickup date" required>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<label for="return_date">Return date</label>
									<input type="date" name="return_date" class="form-control" id="return_date" placeholder="Return date" required>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<label for="payment">Payment</label>
									<select type="option" name="payment" id="payment" required>
										<option value="">Pay now ?</option>
										<option value="T">Yes</option>
										<option value="F">No</option>
									</select>
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
                $result = mysqli_query($conn, "SELECT * FROM `car` WHERE car_plate_id = '$plate_id'");
                $car_status = mysqli_fetch_assoc($result);
                $office_id = $car_status['office_id'];
                if ($car_status['out_of_service'] == '1') {
                    echo '<script>';
                    echo 'alert("This car is Out of Service");';
                    echo '</script>';
                    echo '<script>';
                    echo 'window.location = "reserve_a_car.php"';
                    echo '</script>';
                }
                $ssn = $_POST['ssn'];
                $return_date = $_POST['return_date'];
                $payment = $_POST['payment'];
                $pick_up_date = $_POST['pick_up_date'];
                $reservation_date = date('y-m-d');
                if ($payment=='T'){
                    $paid_at=$reservation_date;
                }else {
                    $paid_at=$pick_up_date;
                }
                //validate the date 
                if (strtotime($reservation_date) < strtotime($pick_up_date) && strtotime($reservation_date) < strtotime($return_date) && strtotime($pick_up_date) < strtotime($return_date)) {
                    $result = mysqli_query($conn, "SELECT * FROM `reservation` WHERE car_plate_id = '$plate_id' AND ((pick_up_date BETWEEN '$pick_up_date' AND  '$return_date') OR (return_date BETWEEN '$pick_up_date' AND '$return_date')  OR ('$pick_up_date' BETWEEN pick_up_date AND return_date) OR ('$return_date' BETWEEN pick_up_date AND return_date))");
                    $clash = mysqli_fetch_assoc($result);
                    if ($clash) {
                        echo '<script>';
                        echo 'alert("There is a clash with another resirvation");';
                        echo '</script>';
                        echo '<script>';
                        echo 'window.location = "reserve_a_car.php "';
                        echo '</script>';
                    } else {
                        $query = "INSERT INTO `reservation` (reservation_date,pick_up_date,return_date,car_plate_id,ssn,office_id,payment,paid_at) VALUES('$reservation_date','$pick_up_date','$return_date','$plate_id', '$ssn','$office_id','$payment','$paid_at')";
                        $result = mysqli_query($conn, $query);
                        echo '<script>';
                        echo 'alert("Reserved successfully");';
                        echo '</script>';

                        echo '<script>';
                        echo 'window.location = "reserve_a_car.php"';
                        echo '</script>';
                    }
                } else {
                    echo '<script>';
                    echo 'alert("Invalid pickup date or return date !");';
                    echo '</script>';
                    echo '<script>';
                    echo 'window.location = "reserve_a_car.php "';
                    echo '</script>';
                }
            }
        
        $conn->close();
        ?>
</body>
</html>