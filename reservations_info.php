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
        <div class="inner">
            <br>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM `car`");
            $models = array();
            $colors = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $models[] = strtolower($row['brand_model']);
                $colors[] = strtolower($row['color']);
            }

            $result = mysqli_query($conn, "SELECT * FROM `office`");
            $locations = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $locations[] = "Location: " . $row['location'] . "||office: " . $row['office_name'];
            }
            ?>

            <div class="container">
                <h2 class="h2">Search in Reservations</h2>
                <br>
                <form class="form-inline" method="post" name="myForm" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="reservation_id" class="form-control" id="reservation_id" placeholder="Reservation Id">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" onkeypress="return event.charCode >= 48" min="1" name="car_plate_id" class="form-control" id="car_plate_id" placeholder="Car plate id">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="ssn" class="form-control" id="ssn" placeholder="SSN">
                    </div>
                    <br><br>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="office_id" id="office_id">
                            <option value="" disabled selected hidden>Location</option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM `office`  order by location ");
                            $office_idss = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $office_idss[] = $row['office_id'];
                            }
                            foreach ($office_idss as $office_id) {
                                $result = mysqli_query($conn, "SELECT * FROM `office` where office_id=$office_id");
                                $row = mysqli_fetch_assoc($result);
                                $office_ids = "Location: " . $row['location'] . "||office: " . $row['office_name'];
                                echo "<option value=\"$office_id\">$office_ids</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="payment" id="payment">
                            <option value="" disabled selected hidden> paid? </option>
                            <option value="T">Yes</option>
                            <option value="F">NO</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="reservation_date">Reservation Date start &nbsp;&nbsp;&nbsp;</label>
                        <input type="date" name="reservation_date_start" class="form-control" id="reservation_date_start" placeholder="reservation_date">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="reservation_date">Reservation Date End &nbsp;&nbsp;&nbsp;</label>
                        <input type="date" name="reservation_date_end" class="form-control" id="reservation_date_end" placeholder="reservation_date">
                    </div>
                    <br><br>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="pick_up_date">Pick Up Date &nbsp;&nbsp;&nbsp;</label>
                        <input type="date" name="pick_up_date" class="form-control" id="pick_up_date" placeholder="pickup date">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="return_date">Return Date &nbsp;&nbsp;&nbsp;</label>
                        <input type="date" name="return_date" class="form-control" id="return_date" placeholder="return date">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search" />
                    <br><br><br>
                    <a style=font-size:20px; href="reserve_a_car.php" class="nav-link">Reserve a Car</a>
                </form>
            </div>
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
                            <th style="text-align: center;">FName</th>
                            <th style="text-align: center;">LName</th>
                            <th style="text-align: center;">Phone</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Age</th>
                            <th style="text-align: center;">Gender</th>

                        </thead>
                        <?php
                        if (isset($_POST['submit'])) {
                            $result = "SELECT * FROM `reservation` Natural join office Natural join car Natural join users  WHERE 1";
                            if ($_POST["reservation_id"] != "") {
                                $result = $result . " AND reservation_id = " . $_POST["reservation_id"];
                            }
/*                            if ($_POST["reservation_date"] != "") {
                                $result = $result . " AND reservation_date = \"" . $_POST["reservation_date"] . "\"";
                            }
*/
                            if ($_POST["reservation_date_start"]) {
                                $flag1 = 1;
                            } else {
                                $flag1 = 0;
                            }
                            if ($_POST["reservation_date_end"]) {
                                $flag2 = 1;
                            } else {
                                $flag2 = 0;
                            }
                            if ($_POST["reservation_date_start"]) {
                                if ($flag2 == 1) {
                                    $result = $result . " AND reservation_date >= \"" . $_POST["reservation_date_start"] . "\"";
                                } else {
                                    $result = $result . " AND reservation_date = \"" . $_POST["reservation_date_start"] . "\"";
                                }
                            }
                            if ($_POST["reservation_date_end"]) {
                                if ($flag1 == 1) {
                                    $result = $result . " AND reservation_date <= \"" . $_POST["reservation_date_end"] . "\"";
                                } else {
                                    $result = $result . " AND reservation_date = \"" . $_POST["reservation_date_end"] . "\"";
                                }
                            }
                            if ($_POST["pick_up_date"]) {
                                $flag1 = 1;
                            } else {
                                $flag1 = 0;
                            }
                            if ($_POST["return_date"]) {
                                $flag2 = 1;
                            } else {
                                $flag2 = 0;
                            }
                            if ($_POST["pick_up_date"]) {
                                if ($flag2 == 1) {
                                    $result = $result . " AND pick_up_date >= \"" . $_POST["pick_up_date"] . "\"";
                                } else {
                                    $result = $result . " AND pick_up_date = \"" . $_POST["pick_up_date"] . "\"";
                                }
                            }
                            if ($_POST["return_date"]) {
                                if ($flag1 == 1) {
                                    $result = $result . " AND return_date <= \"" . $_POST["return_date"] . "\"";
                                } else {
                                    $result = $result . " AND return_date = \"" . $_POST["return_date"] . "\"";
                                }
                            }
                            /*                            if ($_POST["pick_up_date"] && $_POST["return_date"] ) {
                                $result = $result . " AND pick_up_date between \"" . $_POST["pick_up_date"]. "\"" . " AND \"" . $_POST["return_date"]. "\"";
                            }
*/
                            if ($_POST["car_plate_id"]) {
                                $result = $result . " AND car_plate_id  = \"" . $_POST["car_plate_id"] . "\"";
                            }
                            if ($_POST["ssn"] != "") {
                                $result = $result . " AND ssn = " . $_POST["ssn"];
                            }
                            if (isset($_POST["office_id"])) {
                                $result = $result . " AND office_id = \"" . $_POST["office_id"] . "\"";
                            }
                            if (isset($_POST["payment"])) {
                                $result = $result . " AND payment = \"" . $_POST["payment"] . "\"";
                            }
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
                                echo "<td style=\"text-align: center;\">" . $row["fname"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["lname"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["phone"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["email"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["age"] . "</td>";
                                if ($row["gender"] == 'M') {
                                    echo "<td style=\"text-align: center;\">" . "Male" . "</td>";
                                } else {
                                    echo "<td style=\"text-align: center;\">" . "Female" . "</td>";
                                }
                                echo "</tr>";
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
            <br>
</body>

</html>