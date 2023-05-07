<?php

$servername = "localhost";
$username = "root";
$passwor = "";
$dbname = "car_rental";
if (isset($_POST['submit1'])) {
    $loc = $_POST['location1'];
    $branch = $_POST['branch1'];
    $conn = new mysqli($servername, $username, $passwor, $dbname,"3307");
    $result = mysqli_query($conn, "SELECT * FROM `office` where LOWER(office_name) = LOWER('$branch') AND LOWER(location) = LOWER('$loc')");
    $branchResult = mysqli_fetch_assoc($result);
    if ($branchResult) { // if branch exists
        echo '<script>';
        echo 'alert("Branch already exists!");';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
    } else {
        $query = "INSERT INTO `office` (location,office_name) VALUES('$loc','$branch')";
        $result = mysqli_query($conn, $query);
        echo "<script>";
        echo 'alert("Branch added successfully")';
        echo "</script>";

        echo '<script>';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
    }
}
?>