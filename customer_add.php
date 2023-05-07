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
session_start();
$_SESSION['sign_up']="customer_add.php";
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
<nav class="navbar navbar-custom" role="navigation" >
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
    <br><br>
<div id="wrapper">

    <!-- Header -->
    <br>
    <br>
</div>

<!-- Footer -->
<footer id="footer">
    <div class="inner">
        <div class = "container">
            <h2>Customer Registeration</h2>
            <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                <form enctype='multipart/form-data' class="form-inline" method="post"action="signup_process.php" onsubmit="return validateForm()" name="signup-form">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="phone"
                        class="form-control" id="phone" placeholder="Phone No." required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="ssn" class="form-control" id="ssn" placeholder="National ID" required>
                </div>
                <br><br>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Password" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Confirm Password" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="age"
                        class="form-control" id="age" placeholder="  Age  " required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="sex" id="sex" required>
                        <option value="" disabled selected hidden>Male/Female</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <br><br>
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Register"/>
                </form>
            </div>
                            </div>
    </div>
</footer>

</div>
<?php
$conn = $_SESSION['conn'];



?>
<script>
function validateForm() {
    let x = document.forms["signup-form"]["email"].value;
    let y = document.forms["signup-form"]["password"].value;
    let z = document.forms["signup-form"]["confirm-password"].value;
    let w = document.forms["signup-form"]["fname"].value;
    let a = document.forms["signup-form"]["lname"].value;
    let b = document.forms["signup-form"]["age"].value;
    let c = document.forms["signup-form"]["gender"].value;
    let d = document.forms["signup-form"]["phone"].value;
    let e = document.forms["signup-form"]["ssn"].value;


    if (x == "" && y == "" && z == "" && w == "" && a == "" && b == "" && c == "" && d == "" && e == "") {
        alert("fill out the form");
        return false;
    } else if (w == "") {
        alert("First Name must be filled out");
        return false;
    } else if (a == "") {
        alert("Last Name must be filled out");
        return false;
    } else if (e == "") {
        alert("National ID must be filled out");
        return false;
    } else if (d == "") {
        alert("Phone Number must be filled out");
        return false;
    }else if (x == "") {
        alert("email must be filled out");
        return false;
    } else if (y == "") {
        alert("password must be filled out");
        return false;
    } else if (z == "") {
        alert("confirm password must be filled out");
        return false;
    }
    if (y != z) {
        alert("please enter the same password");
        return false;
    } else if (b == "") {
        alert("Age must be filled out");
        return false;
    } else if (c == "") {
        alert("please select gender");
        return false;
    } 


    return true;
}
</script>

?>
</body>
</html>
