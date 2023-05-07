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
    <br><br><br>
    <div id="wrapper">
        <div class="inner">

            <?php
            $result = mysqli_query($conn, "SELECT * FROM `car`");
            $brands = array();
            $models = array();
            $colors = array();
            $types = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $brands[] = strtolower($row['brand_name']);
                $models[] = strtolower($row['brand_model']);
                $colors[] = strtolower($row['color']);
                $types[] = strtolower($row['Type']);
            }

            $result = mysqli_query($conn, "SELECT * FROM `office`");
            $locations = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $locations[] = "Location: " . $row['location'] . "||office: " . $row['office_name'];
            }
            ?>

            <div class="container">
                <h2 class="h2">Search</h2>
                <form class="form-inline" method="post" name="myForm" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="plate_id" class="form-control" id="plate_id" placeholder="Plate ID">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="year" class="form-control" id="year" placeholder="Year">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_price" class="form-control" id="min_price" placeholder="Min. Price">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="max_price" class="form-control" id="max_price" placeholder="Max. Price">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_power" class="form-control" id="min_power" placeholder="Min. Horse Power">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="brand" id="brand">
                            <option value="" disabled selected hidden>Brand</option>
                            <?php
                            foreach (array_unique($brands) as &$brand) {
                                echo "<option value=\"$brand\">$brand</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group mx-sm-3 mb-2">
                        <select name="color" id="color">
                            <option value="" disabled selected hidden>Color</option>
                            <?php
                            foreach (array_unique($colors) as &$color) {
                                echo "<option value=\"$color\">$color</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="office_id" id="office_id">
                            <option value="" disabled selected hidden>Location</option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM `office` order by location ");
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
                        <select name="automatic" id="automatic">
                            <option value="" disabled selected hidden>Automatic/Manual</option>
                            <option value="1">Automatic</option>
                            <option value="0">Manual</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="cur_state">Current Status for date</label>
                        <input type="date" name="cur_state" class="form-control" id="cur_state" placeholder="Current status">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search" />
                    <br><br><br>
                     <a href="cars_add.php" class="nav-link"> ADD CARS&nbsp;&nbsp;</a>
                    <a href="car_status.php" class="nav-link"> CAR Status &nbsp;&nbsp;</a>
                    <a href="car_deletion.php" class="nav-link"> CAR Deletion &nbsp;&nbsp;</a>
                    <a href="edit_car.php" class="nav-link"> CAR Modification &nbsp;&nbsp;</a>
                </form>
            </div>
            <br>



            <div class="container">
                <h1>Car</h1>
                <div>
                    <table class="table table-striped">
                        <thead>
                            <th style="text-align: center;">Plate id</th>
                            <th style="text-align: center;">Brand</th>
                            <th style="text-align: center;">Model</th>
                            <th style="text-align: center;">Year</th>
                            <th style="text-align: center;">Type</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Price</th>
                            <th style="text-align: center;">Color</th>
                            <th style="text-align: center;">Power</th>
                            <th style="text-align: center;">Automatic/Manual</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Office_Name</th>
                        </thead>
                        <?php
                        if (isset($_POST['submit'])) {
                            $result = "SELECT * FROM `car` Natural join office WHERE 1";
                            if ($_POST["plate_id"] != "") {
                                $result = $result . " AND car_plate_id = \"" . $_POST["plate_id"] . "\"";
                            }
                            if (isset($_POST["brand"])) {
                                $result = $result . " AND brand_name = \"" . $_POST["brand"] . "\"";
                            }
                            if ($_POST["year"] != "") {
                                $result = $result . " AND year = " . $_POST["year"];
                            }
                            if ($_POST["min_price"] != "") {
                                $result = $result . " AND price >= " . $_POST["min_price"];
                            }
                            if ($_POST["max_price"] != "") {
                                $result = $result . " AND price <= " . $_POST["max_price"];
                            }
                            if (isset($_POST["color"])) {
                                $result = $result . " AND color = \"" . $_POST["color"] . "\"";
                            }
                            if ($_POST["min_power"] != "") {
                                $result = $result . " AND hourse_power >= " . $_POST["min_power"];
                            }
                            if (isset($_POST["office_id"])) {
                                $result = $result . " AND office_id = \"" . $_POST["office_id"] . "\"";
                            }
                            if (isset($_POST["automatic"])) {
                                $result = $result . " AND automatic = \"" . $_POST["automatic"] . "\"";
                            }
                            if ($_POST["cur_state"] != "") {
                                $temp = $result . " AND car_plate_id not in (SELECT car_plate_id FROM car_status WHERE (\"" . $_POST["cur_state"] . "\" >= out_of_service_start_date and  \"" . $_POST["cur_state"] . "\" < out_of_service_end_date) or (\"" . $_POST["cur_state"] . "\" >=out_of_service_start_date AND out_of_service_end_date is null))";
                                $result = $result . " AND car_plate_id in (SELECT car_plate_id FROM car_status WHERE (\"" . $_POST["cur_state"] . "\" >= out_of_service_start_date and  \"" . $_POST["cur_state"] . "\" <out_of_service_end_date) or (\"" . $_POST["cur_state"] . "\" >=out_of_service_start_date AND out_of_service_end_date is null))";
                            }
                            $result = mysqli_query($conn, $result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style=\"text-align: center;\">" . $row["car_plate_id"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["brand_name"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["brand_model"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["Type"] . "</td>";
                                $status = "Available";
                                if ($row["out_of_service"] == '1' || $_POST["cur_state"] != "") {
                                    $status = "Unavailable";
                                }
                                echo "<td style=\"text-align: center;\">" . $status . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["hourse_power"] . "</td>";
                                if ($row["automatic"] == 1) {
                                    echo "<td style=\"text-align: center;\">" . "Automatic" . "</td>";
                                } else {
                                    echo "<td style=\"text-align: center;\">" . "Manual" . "</td>";
                                }
                                echo "<td style=\"text-align: center;\">" . $row["location"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["office_name"] . "</td>";
                                echo "</tr>";
                            }
                            if ($_POST["cur_state"] != "") {
                                $result = mysqli_query($conn, $temp);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td style=\"text-align: center;\">" . $row["car_plate_id"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["brand_name"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["brand_model"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["Type"] . "</td>";
                                    $status = "Available";
                                    echo "<td style=\"text-align: center;\">" . $status . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["hourse_power"] . "</td>";
                                    if ($row["automatic"] == 1) {
                                        echo "<td style=\"text-align: center;\">" . "Automatic" . "</td>";
                                    } else {
                                        echo "<td style=\"text-align: center;\">" . "Manual" . "</td>";
                                    }
                                    echo "<td style=\"text-align: center;\">" . $row["location"] . "</td>";
                                    echo "<td style=\"text-align: center;\">" . $row["office_name"] . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <?php include 'scripts.php'; ?>

</body>

</html>