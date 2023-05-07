<?php
$servername = "localhost";
$username = "root";
$passwor = "";
$dbname = "car_rental";

if (isset($_GET['car_plate_id'])) {
    $conn = new mysqli($servername, $username, $passwor, $dbname, '3307');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT img FROM car WHERE car_plate_id=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $_GET['car_plate_id']);
    $statement->execute();
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    echo $row["img"];
    
    $conn->close();

}
?>