<?php
$servername = "localhost";
$username = "root";
$passwor = "";
$dbname = "car_rental";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = ($_POST['password']);
    // Create connection
    $conn = new mysqli($servername, $username, $passwor, $dbname,"3307");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $sql3 = "SELECT fname,lname FROM admin WHERE email='$email' AND password='$password'";
    
    $result1 = mysqli_query($conn, $sql1);
    $result3 = mysqli_query($conn, $sql3);

    $row1 = mysqli_fetch_row($result3);

    $count1 = mysqli_num_rows($result1);

    if ($count1 > 0) {
?>
        <?php include 'admin_dashboard.php';?>
<?php
    
    }else {
        echo '<script>';
        echo 'alert("Wrong email or password");';
        echo '</script>';
        
        echo '<script>';
        echo 'window.location = "signinadmin.php"';
        echo '</script>';
            }
    $conn->close();
}

?>

