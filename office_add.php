<?php
$servername = "localhost";
$username = "root";
$passwor = "";
$dbname = "car_rental";
if (isset($_POST['submit0'])) {

if (isset($_POST['location0']) && isset($_POST['branch0']) ) {
    $conn = new mysqli($servername, $username, $passwor, $dbname,"3307");
    $loc = $_POST['location0'];
    $branch = $_POST['branch0'];
    $result = mysqli_query($conn, "SELECT * FROM `office` where location = '$loc' AND office_name='$branch' ");
    $locResult = mysqli_fetch_assoc($result);
    if ($locResult) { // if location exists
        echo '<script>';
        echo 'alert("Location already exists!");';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
    } else {
        $query = "INSERT INTO `office` (location,office_name) VALUES('$loc','$branch')";
        $result = mysqli_query($conn, $query);
        echo "<script>";
        echo 'alert("Location and Branch added successfully")';
        echo "</script>";

        echo '<script>';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
        exit();
    }
}
}
?>