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
    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black">RENTIX</h1>
                            <br><br><br><br><br><br><br>
                            <p class="intro-text">
                                الشركة المصرية لتجارة السيارات ترحب بكم
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>


    <?php
    if (isset($_SESSION['login_customer'])) {
    ?>
        <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
            <h3 style="text-align:center;">Available Cars</h3>
            <br>
            <section class="menu-content">
                <?php
                $sql1 = "SELECT * FROM car Natural join office WHERE out_of_service ='0'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $car_id = $row1["car_plate_id"];
                        $car_name = $row1["brand_name"];
                        $car_model = $row1["brand_model"];
                        $price = $row1["price"];
                        $color = $row1["color"];
                        $hourse_power = $row1["hourse_power"];
                        $car_img = $row1["img"];
                        $type = $row1["Type"];
                        $office_name = $row1["office_name"];
                        $location = $row1["location"];
                        $automatic = $row1["automatic"];
                        if ($automatic == 1) {
                            $automatic= "Automatic";
                        } else {
                            "Manual";
                        }
                        $year = $row1["year"];
                ?>
                            <div class="sub-menu">
                            <a href="reserve.php?id=<?php echo $car_id;?>">
                            <img class="card-img-top" src="images/<?php echo $car_img; ?>" alt="Card image cap">
                                <h5><b> <?php echo $car_name; ?> </b></h5>
                                <h6> Car model: <?php echo (" " . $car_model . " | " . $year . " | "  . $color . " | "   . $type . " | "   . $automatic . " | hourse_power: " . $hourse_power); ?></h6>
                                <h6> Location: <?php echo (" " . $location . " | office_name: " . $office_name . " | Price: " . $price . "/day"); ?></h6>
                            </div>
                        </a>
                    <?php }
                } else {
                    ?>
                    <h1> No cars available :( </h1>
                <?php
                }
                ?>
            </section>
        </div>
    <?php
    } else {
    ?>

        <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
            <h3 style="text-align:center;">Available Cars</h3>
            <br>
            <section class="menu-content">
                <?php
                $sql1 = "SELECT * FROM car Natural join office WHERE out_of_service ='0'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $car_id = $row1["car_plate_id"];
                        $office_id = $row1["office_id"];
                        $car_name = $row1["brand_name"];
                        $car_model = $row1["brand_model"];
                        $price = $row1["price"];
                        $color = $row1["color"];
                        $hourse_power = $row1["hourse_power"];
                        $car_img = $row1["img"];
                        $type = $row1["Type"];
                        $office_name = $row1["office_name"];
                        $location = $row1["location"];
                        $automatic = $row1["automatic"];
                        if ($automatic == 1) {
                            $automatic= "Automatic";
                        } else {
                            "Manual";
                        }
                        $year = $row1["year"];
                ?>
                        <div class="sub-menu">
                        <img class="card-img-top" src="images/<?php echo $car_img; ?>" alt="Card image cap">
                            <h5><b> <?php echo $car_name; ?> </b></h5>
                            <h6> Car model: <?php echo (" " . $car_model . " | " . $year . " | "  . $color . " | "   . $type . " | "   . $automatic . " | hourse_power: " . $hourse_power); ?></h6>
                            <h6> Location: <?php echo (" " . $location . " | office_name: " . $office_name . " | Price: " . $price . "/day"); ?></h6>
                        </div>
                    <?php }
                } else {
                    ?>
                    <h1> No cars available :( </h1>
                <?php
                }
                ?>
            </section>
        </div>
    <?php   }
    ?>

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5> RENTIX &copy;</h5>
                </div>

            </div>
        </div>
    </footer>
    </script>
</body>

</html>