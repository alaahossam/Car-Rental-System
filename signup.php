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
<!DOCTYPE html>
<html lang="en">

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

<!--INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100141','Ahmed','Falah','falah@gmail.com','falah',21,'M','01010101013'); -->


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
    </nav>
    <br><br><br><br>
    <footer id="footer">
        <div class="inner">
            <div class="container">
                <h2>SIGN UP</h2>
                <div class="card text-center" style="margin-top:10px;background: transparent">
                    <form enctype='multipart/form-data' class="form-inline" method="POST" action="signup_process.php" onsubmit="return validateForm()" name="signup-form">
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="text" name="ssn" id="ssn" placeholder="National ID" required />
                        </div>
                        <br>
                        <br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="email" name="email" id="email" placeholder="email" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="password" name="password" id="password" placeholder="password" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="password" name="confirm-password" placeholder="confirm password" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="int" name="age" id="age" placeholder="Age" required />
                        </div>
                        <br><br>
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="phone number" required />
                        </div>
                        <br>
                        <div class="form-group mx-sm-3 mb-2">
                            <label style="color:white;font-size:20;margin-left:60%" class="form-control-plaintext">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="" disabled selected hidden>Male/Female</option>
                                <option class="form-control-plaintext" value="F">Female</option>
                                <option class="form-control-plaintext" value="M">Male</option>
                            </select>
                        </div>
                        <br><br>
                        <div style="margin-left:0%">
                            <input style="color:white;background-color:red;border: none;font-size:20;margin-left:0%" type='submit' id="submit" name='sign_up' class="btn btn-success" value='Sign Up' />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>

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
            } else if (e == "") {
                alert("National ID must be filled out");
                return false;
            } else if (w == "") {
                alert("First Name must be filled out");
                return false;
            } else if (a == "") {
                alert("Last Name must be filled out");
                return false;
            } else if (x == "") {
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
            } else if (d == "") {
                alert("Phone Number must be filled out");
                return false;
            }


            return true;
        }
    </script>
</body>

</html>