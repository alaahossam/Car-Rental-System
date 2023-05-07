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
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script>
    function validateLocationBranchForm() {
    var fields = ["location", "office_name"];
    var n = fields.length;
    var errors = [];
    for (var i = 0; i < n; i++) {
        var fieldname = fields[i];
        if (document.forms["myForm0"][fieldname].value == "") {
            errors.push(fieldname);
        }
    }
    if (errors.length) {
        alert(errors.join() + " must be filled out");
        return false;
    }
}
function validateBranchForm() {
    var fields = ["office_name"];
    var n = fields.length;
    var errors = [];
    for (var i = 0; i < n; i++) {
        var fieldname = fields[i];
        if (document.forms["myForm1"][fieldname].value == "") {
            errors.push(fieldname);
        }
    }
    if (errors.length) {
        alert(errors.join() + " must be filled out");
        return false;
    }
}
</script>


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <form class="form-inline" method="post" name="myForm0" action="office_add.php" onsubmit="return validateLocationBranchForm();">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="location0" class="form-control" id="location0" placeholder="Location" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="branch0" class="form-control" id="branch0" placeholder="office" required>
            </div>
            <input type="submit" name="submit0" class="btn btn-primary mb-2" value="Add a new location and office" />
        </form>
        <br>
        <br>
        <form class="form-inline" method="post" name="myForm1" action="office_second_add.php" onsubmit="return validateBranchForm();">
            <div class="form-group mx-sm-3 mb-2">
                <select name="location1" id="location1" required>
                    <option value="" disabled selected hidden>Location</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT distinct location FROM `office` order by location");
                    $locations = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $locations[] = $row['location'];
                    }
                    foreach ($locations as &$location) {
                        echo "<option value=\"$location\">$location</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="branch1" class="form-control" id="branch1" placeholder="office" required>
            </div>
            <input type="submit" name="submit1" class="btn btn-primary mb-2" value="Add New Branch for existing location" />
        </form>
    </div>
    <div class="inner">
        <br><br>
        <div class="container">
            <h2>Active Cars</h2>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Car_ID</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Model</th>
                                <th scope="col">Image</th>
                                <th scope="col">price</th>
                                <th scope="col">color</th>
                                <th scope="col">Location</th>
                                <th scope="col">office name</th>
                                <th scope="col">Type</th>
                                <th scope="col">automatic</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM `car` Natural join office WHERE out_of_service = '0'");
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $result1=mysqli_query($conn, "SELECT * FROM `office` WHERE 1 ". " AND 'office_id' = \"" . $row['office_id'] . "\"");
                                    $row1 = mysqli_fetch_assoc($result1);    
                                    echo "<th scope=\"row\">" . "<a href=\"car_status.php?plate_id=" . $row["car_plate_id"] . "\">" . $counter . "</th>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["car_plate_id"] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row["brand_name"] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row["brand_model"] .
                                        "</td>";
                                    echo "<td class=\"w-25\">" .
                                        "<img style=\"width:300px;height:200px;\" src=\"images/" . $row["img"] . "\" alt=\"\"/>" .
                                        "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["price"] .
                                        "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["color"] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row['location'] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row['office_name'] .
                                        "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["Type"] .
                                        "</td>";
                                    if ($row["automatic"] == 1) {
                                        echo "<td>" .
                                            "<p> <strong>" . "Automatic" .
                                            "</td>";
                                    } else {
                                        echo "<td>" .
                                            "<p> <strong>" . "Manual" .
                                            "</td>";
                                    }
                                    echo "</tr>";
                                    $counter = $counter + 1;
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br> <br>
        <div class="container">
            <h2>Not Active Cars</h2>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Car_ID</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Model</th>
                                <th scope="col">Image</th>
                                <th scope="col">price</th>
                                <th scope="col">color</th>
                                <th scope="col">Location</th>
                                <th scope="col">office name</th>
                                <th scope="col">Type</th>
                                <th scope="col">automatic</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM `car` Natural join office WHERE out_of_service = '1'");
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<th scope=\"row\">" . "<a href=\"car_status.php?plate_id=" . $row["car_plate_id"] . "\">" . $counter . "</th>";
                                    echo "<td>" .
                                    "<p> <strong>" . $row["car_plate_id"] .
                                    "</td>";
                                    echo "<td>" .
                                    "<p> <strong>" . $row["brand_name"] .
                                    "</td>";
                                    echo "<td>" .
                                    "<p> <strong>" . $row["brand_model"] .
                                    "</td>";
                                    echo "<td class=\"w-25\">" .
                                    "<img style=\"width:300px;height:200px;\" src=\"images/" . $row["img"] . "\" alt=\"\"/>" .
                                    "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["price"] .
                                        "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["color"] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row['location'] .
                                        "</td>";
                                        echo "<td>" .
                                        "<p> <strong>" . $row['office_name'] .
                                        "</td>";
                                    echo "<td>" .
                                        "<p> <strong>" . $row["Type"] .
                                        "</td>";
                                    if ($row["automatic"] == 1) {
                                        echo "<td>" .
                                            "<p> <strong>" . "Automatic" .
                                            "</td>";
                                    } else {
                                        echo "<td>" .
                                            "<p> <strong>" . "Manual" .
                                            "</td>";
                                    }
                                    echo "</tr>";
                                    $counter = $counter + 1;
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>