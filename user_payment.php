<?php include 'redirectLoggedIn.php'; ?>
<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <title>RENTIX</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <style>
        div.container4 {
            height: 10em;
            position: relative
        }

        div.container4 p {
            margin: 0;
            position: absolute;
            top: 150%;
            font-size: 30px;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
    </style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    RENTIX </a>
            </div>

            <?php
            if (isset($_SESSION['login_customer'])) {
                $ssn = $_SESSION['login_customer'];
                $sql1 = "SELECT * FROM users WHERE ssn ='$ssn'";
                $result1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
                $fname = $row1["fname"];


            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $fname; ?></a>
                        </li>
                        <li> <a href="user_payment.php">My Payments</a></li>
                        <li> <a href="mybookings.php"> My Bookings</a></li>
                        <li>
                            <a href="Filter_process.php">Car Search</a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>
            <?php   }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <br><br><br><br><br><br><br><br><br>
    <footer id="footer">
        <div class="inner">
            <div class="container">
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

                /*lma terboteh b ssn*/
                //$ssn = $_SESSION['ssn'];
                //$query = "SELECT car_plate_id, pick_up_date, return_date,location, img, brand_model, year, color, automatic, price FROM `car` NATURAL JOIN `reservation` WHERE ssn='$ssn' AND  payment = 'F'";

                $query = "SELECT car_plate_id, pick_up_date, return_date,location, img, brand_model, year, color, automatic, price FROM `car` NATURAL JOIN `reservation`Natural join office WHERE   payment = 'F'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    //    echo "<h1>No payments due !</h1>";
                ?> <div class=container4>
                        <p>No payments due !
                    </div>
                <?php


                } else {
                    echo "<h2>Reservations</h2>";

                ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">img</th>
                                <th scope="col">Model</th>
                                <th scope="col">Year</th>
                                <th scope="col">Color</th>
                                <th scope="col">Type</th>

                                <th scope="col">PlateID</th>
                                <th scope="col">Pickup_date</th>
                                <th scope="col">Location</th>
                                <th scope="col">Return_date</th>
                                <th scope="col">Price/day</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $reserv_num = 1;
                            $total_amount = 0;
                            while ($car = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th>" . $reserv_num . "</th>";
                                $reserv_num = $reserv_num + 1;
                                echo "<th> <img src=\"images/" . $car['img'] . "\"  style=\"width: 250px; height: 150px;\"> </th>";
                                echo "<th scope=\"col\">" . $car['brand_model'] . "</th>";
                                echo "<th scope=\"col\"> " . $car['year'] . "</th>";
                                echo "<th scope=\"col\"> " . $car['color'] . "</th>";
                                if ($car['automatic'] === 'T') {
                                    $type = "Automatic";
                                } else {
                                    $type = "Manual";
                                }
                                echo "<th scope=\"col\">" . $type . "</li>";
                                echo "<th scope=\"col\">" . $car['car_plate_id'] . "</th>";
                                echo "<th scope=\"col\">" . $car['pick_up_date'] . "</th>";
                                echo "<th scope=\"col\">" . $car['location'] . "</th>";
                                echo "<th scope=\"col\">" . $car['return_date'] . "</th>";
                                echo "<th scope=\"col\">" . $car['price'] . "</th>";

                                $start_date = strtotime($car['pick_up_date']);
                                $end_date = strtotime($car['return_date']);
                                $days = (($end_date - $start_date) / 60 / 60 / 24) + 1;  //calculate number of reservation days
                                $cost_per_day = $car['price'];  //price of the car per day
                                $amount_per_reservation = $cost_per_day * $days;  //total amount to be paid
                                $total_amount = $total_amount + $amount_per_reservation;
                                echo "<th scope=\"col\">" . $amount_per_reservation . "</th>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo "<h3>Total amount to be paid: $" . $total_amount . "</h3>";
                        echo "<form action=\"\" method=\"post\">
                    <input type=\"submit\" name=\"submit\" class=\"btn btn-primary mb-2\" value=\"Pay\"/>
                </form>";
                    }
                }
                    ?>
                    </div>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
    if ($total_amount > 0) {
        $query = "SELECT car_plate_id, pick_up_date, return_date,location, img, brand_model, year, color, automatic, price FROM `car` NATURAL JOIN `reservation`Natural join office WHERE   payment = 'F'";
        $result = mysqli_query($conn, $query);
        $car = mysqli_fetch_assoc($result);
        $start_date = $car['pick_up_date'];
        $current_date = date("Y-m-d");
        //lma nerbot hena el ssn han7ot el query de badal elly ta7taha
        //$query = "UPDATE `reservation` SET payment = 'T', paid_at = '$current_date' WHERE ssn= '$ssn'  paid_at= '$start_date'";
        $query = "UPDATE `reservation` SET payment = 'T', paid_at = '$current_date' WHERE  paid_at= '$start_date'";
        $result = mysqli_query($conn, $query);

        echo "<script>";
        echo "alert('Payment made successfully')";
        echo "</script>";
        echo '<script>';
        echo 'window.location = "index.php"';
        echo '</script>';
    } else {
        echo "<script>";
        echo "payment not done";
        echo "</script>";
    }
}
?>