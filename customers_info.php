
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,"3307");
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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
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
                    <li class = "nav-link">
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
        
        <div class = "container">
        <h2 class="h2">Search Customers Information</h2>
        <br><br>
            <form class="form-inline" method="post" name="myForm" action="">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="phone"
                        class="form-control" id="phone" placeholder="Phone No.">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <br><br>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="sex" id="sex">
                        <option value="" disabled selected hidden>Male/Female</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_age"
                        class="form-control" id="min_age" placeholder="Min. Age">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="max_age"
                        class="form-control" id="max_age" placeholder="Max. Age">
                </div>
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search"/>
                <br><br><br>
                <a href="customer_add.php" class="nav-link">ADD CUSTOMER</a>
            </form>
</div>
        <br><br><br>
        <div class = "container">
        <h1>User</h1>
            <div >
                <table class="table table-striped">
                    <thead>
                    <th style="text-align: center;">SSN</th>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Phone</th>
                    <th style="text-align: center;">Emaill</th>
                    <th style="text-align: center;">Sex</th>
                    <th style="text-align: center;">Birth Date</th>
                    </thead>
                    <?php
                    if (isset($_POST['submit'])) {
                        $result = "SELECT * FROM `users` WHERE 1";
                        if ($_POST["fname"] != "") {
                            $result = $result . " AND LOWER(fname) = LOWER(\"" . $_POST["fname"] . "\")";
                        }
                        if ($_POST["lname"] != "") {
                            $result = $result . " AND LOWER(lname) = LOWER(\"" . $_POST["lname"] . "\")";
                        }
                        if ($_POST["phone"] != "") {
                            $result = $result . " AND phone = \"" . $_POST["phone"] . "\"";
                        }
                        if ($_POST["email"] != "") {
                            $result = $result . " AND email = \"" . $_POST["email"] . "\"";
                        }
                        if (isset($_POST["sex"])) {
                            $result = $result . " AND gender = \"" . $_POST["sex"] . "\"";
                        }
                        if ($_POST["min_age"] != "") {
                            $result = $result . " AND age >= \"" . $_POST["min_age"] . "\"";
                        }
                        if ($_POST["max_age"] != "") {
                            $result = $result . " AND age <= \"" . $_POST["max_age"] . "\"";
                        }
                        $result = mysqli_query($conn, $result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">" . $row["ssn"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["fname"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["lname"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["phone"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["email"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["gender"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["age"] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
                </div>
    </div>

</body>
</html>