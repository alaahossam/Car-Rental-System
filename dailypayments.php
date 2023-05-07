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
                <h2>Choose Day/period</h2>
                <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                    <form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="payment_start_date">Payment Start date</label>
                            <input type="date" name="payment_start_date" id="payment_start_date" placeholder="Payment Start date" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="payment_end_date">Payment End Date</label>
                            <input type="date" name="payment_end_date" id="payment_end_date" placeholder="Payment End date">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search" />
                    </form>
                </div>
            </div>
        </div>
    </footer>

    </div>
    <?php
    if (isset($_POST['submit'])) {
        $result = "SELECT * FROM `reservation` NATURAL JOIN `car` NATURAL JOIN `users` WHERE 1";

        if ($_POST["payment_start_date"] != "") {
            $result = $result . " AND paid_at >= \"" . $_POST["payment_start_date"] . "\"";
        }
        if ($_POST["payment_end_date"] != "") {
            $result = $result . " AND paid_at <= \"" . $_POST["payment_end_date"] . "\"";
        }
        $result = mysqli_query($conn, $result);
    }
    /*lma tzwdy el payment hat7oteha hena .. el mafrod ht3mly paid at w takhdy el twarekh bta3t el daf3
					w ba3den t3mly query t7sby beha el total dailypayments*/
    ?>
    <div class="container">
        <h2>Payments</h2>
        <div>
            <table class="table table-striped">
                <thead>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Total Daily Payment</th>
                </thead>
                <?php
                if (isset($_POST['submit'])) {
                    $res = "SELECT paid_at,SUM(price* (DATEDIFF(return_date, pick_up_date) + 1)) AS totaldailypayment FROM car as C inner join reservation as R on C.car_plate_id=R.car_plate_id WHERE 1";
                    if ($_POST["payment_start_date"] != "") {
                        $res = $res . " AND paid_at >= \"" . $_POST["payment_start_date"] . "\"";
                    }
                    if ($_POST["payment_end_date"] != "") {
                        $res = $res . " AND paid_at <= \"" . $_POST["payment_end_date"] . "\"";
                    }
                    if ($_POST["payment_end_date"] == "") {
                        $res = $res . " AND paid_at <= \"" . $_POST["payment_start_date"] . "\"";
                    }
                    if ($_POST["payment_start_date"] != "" or $_POST["payment_end_date"] != "") {
                        $res = $res . " AND paid_at is not null GROUP BY paid_at ";
                        $result = mysqli_query($conn, $res);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">" . $row["paid_at"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["totaldailypayment"] . "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>