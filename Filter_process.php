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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
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
    <br><br><br><br>
    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Cars Filter</h3>
        <br>

        <section class="menu-content">
            <div id="wrapper">
                <div class="inner">

                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `car`");
                    $brands = array();
                    $models = array();
                    $colors = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $brands[] = strtolower($row['brand_name']);
                        $models[] = strtolower($row['brand_model']);
                        $colors[] = strtolower($row['color']);
                        $Types[] = strtolower($row['Type']);
                    }

                    $result = mysqli_query($conn, "SELECT distinct location FROM `office`");
                    $locations = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $locations[] = $row['location'];
                    }
                    ?>

                    <div class="container">
                        <form class="form-inline" method="post" name="myForm" action="">
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
                                <select name="automatic" id="automatic">
                                    <option value="" disabled selected hidden>Automatic/Manual</option>
                                    <option value="1">Automatic</option>
                                    <option value="0">Manual</option>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="Type" id="Type">
                                    <option value="" disabled selected hidden>Type</option>
                                    <?php
                                    foreach (array_unique($Types) as &$Type) {
                                        echo "<option value=\"$Type\">$Type</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br><br>
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
                            <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search" />
                        </form>
                    </div>
                    <br>
        </section>

        <?php
        if (isset($_SESSION['login_customer'])) {
        ?>
            <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
                <h3 style="text-align:center;">Cars</h3>
                <br>
                <section class="menu-content">
                    <?php
                    if (isset($_POST['submit'])) {
                        $result = "SELECT * FROM `car` Natural join office WHERE 1";
                        if (isset($_POST["brand"])) {
                            $result = $result . " AND brand_name = \"" . $_POST["brand"] . "\"";
                        }
                        if (isset($_POST["model"])) {
                            $result = $result . " AND brand_model = \"" . $_POST["model"] . "\"";
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
                        if (isset($_POST["Type"])) {
                            $result = $result . " AND Type = \"" . $_POST["Type"] . "\"";
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
                        $result = mysqli_query($conn, $result);
                        while ($row1 = mysqli_fetch_assoc($result)) {
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
                                $automatic = "Automatic";
                            } else {
                                "Manual";
                            }
                            $year = $row1["year"];
                    ?>
                            <a href="reserve.php?id=<?php echo ($car_id); ?>">
                                <div class="sub-menu">
                                    <img class="card-img-top" src="images/<?php echo $car_img; ?>" alt="Card image cap">
                                    <h5><b> <?php echo $car_name; ?> </b></h5>
                                    <h6> Car model:
                                        <?php echo (" " . $car_model . " | " . $year . " | "  . $color . " | "   . $type . " | "   . $automatic . " | hourse_power: " . $hourse_power); ?>
                                    </h6>
                                    <h6> Location: <?php echo (" " . $location . " | office_name: " . $office_name . " | Price: " . $price . "/day"); ?></h6>
                                </div>
                            </a>
                        <?php }
                    } else {
                        ?>
                        <h1> Want to search? :) </h1>
                    <?php
                    }
                    ?>
            </div>
            </section>
    </div>

<?php
        } else {
?>
    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Cars</h3>
        <br>
        <section class="menu-content">
            <?php
            if (isset($_POST['submit'])) {
                $result = "SELECT * FROM `car` Natural join office WHERE 1";
                if (isset($_POST["brand"])) {
                    $result = $result . " AND brand_name = \"" . $_POST["brand"] . "\"";
                }
                if (isset($_POST["model"])) {
                    $result = $result . " AND brand_model = \"" . $_POST["model"] . "\"";
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
                $result = mysqli_query($conn, $result);
                while ($row1 = mysqli_fetch_assoc($result)) {
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
                        $automatic = "Automatic";
                    } else {
                        "Manual";
                    }
                    $year = $row1["year"];
            ?>
                    <div class="sub-menu">
                        <img class="card-img-top" src="images/<?php echo $car_img; ?>" alt="Card image cap">
                        <h5><b> <?php echo $car_name; ?> </b></h5>
                        <h6> Car model:
                            <?php echo (" " . $car_model . " | " . $year . " | "  . $color . " | "   . $type . " | "   . $automatic . " | hourse_power: " . $hourse_power); ?>
                        </h6>
                        <h6> Location: <?php echo (" " . $location . " | office_name: " . $office_name . " | Price: " . $price . "/day"); ?></h6>
                    </div>
                    </a>
                <?php }
            } else {
                ?>
                <h1> Want to search? :) </h1>
            <?php
            }
            ?>
    </div>
    </section>
    </div>

<?php
        }
?>
<?php include 'scripts.php'; ?>
</body>

</html>