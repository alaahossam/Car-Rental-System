<?php include 'redirectLoggedIn.php'; ?>
<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentix</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <!--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> -->
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
            <?php
            } else {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="signin.php">Customer login</a>
                        </li>
                        <li>
                            <a href="signup.php">Register</a>
                        </li>
                        <li>
                            <a href="signinadmin.php">Admin Login</a>
                        </li>
                        <li>
                            <a href="Filter_process.php">Car Search</a>
                        </li>
                    </ul>
                </div>
            <?php   }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <br><br>
    <div id="wrapper">
        <div class="inner">
            <br><br><br><br>
            <div class="container">
                <h1>Reservation</h1>
                <div style="overflow-x:auto;width:100%;height:500px">
                    <table class="table table-striped">
                        <thead>
                            <th style="text-align: center;">Reservation_id</th>
                            <th style="text-align: center;">Reservation_Date</th>
                            <th style="text-align: center;">Pickup_Date</th>
                            <th style="text-align: center;">Return_Date</th>
                            <th style="text-align: center;">Payement</th>
                            <th style="text-align: center;">Payment_Date</th>
                            <th style="text-align: center;">Office_Name</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Car_plate_id </th>
                            <th style="text-align: center;">Brand_Name</th>
                            <th style="text-align: center;">Brand_Model</th>
                            <th style="text-align: center;">Color</th>
                            <th style="text-align: center;">Year</th>
                            <th style="text-align: center;">Type</th>
                            <th style="text-align: center;">price</th>
                            <th style="text-align: center;">hourse_power</th>
                            <th style="text-align: center;">Automatic</th>
                            <th style="text-align: center;">SSN</th>
                        </thead>
                        <?php
                            $result = "SELECT * FROM `reservation` Natural join office Natural join car  WHERE ssn=$ssn";
                            $result = mysqli_query($conn, $result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style=\"text-align: center;\">" . $row["reservation_id"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["reservation_date"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["pick_up_date"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["return_date"] . "</td>";
                                if ($row["payment"] == 'T') {
                                    echo "<td style=\"text-align: center;\">" . "Yes" . "</td>";
                                } else {
                                    echo "<td style=\"text-align: center;\">" . "No" . "</td>";
                                }
                                echo "<td style=\"text-align: center;\">" . $row["paid_at"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["office_name"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["location"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["car_plate_id"] . "</td>";

                                echo "<td style=\"text-align: center;\">" . $row["brand_name"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["brand_model"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["Type"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["hourse_power"] . "</td>";
                                if ($row["automatic"] == 1) {
                                    echo "<td style=\"text-align: center;\">" . "Automatic" . "</td>";
                                } else {
                                    echo "<td style=\"text-align: center;\">" . "Manual" . "</td>";
                                }
                                echo "<td style=\"text-align: center;\">" . $row["ssn"] . "</td>";                                
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
            <br>
</body>

</html>