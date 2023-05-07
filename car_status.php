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
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/main.css" />

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
  <br><br>
  <div id="wrapper">

    <!-- Header -->
    <br>
    <br>
  </div>

  <!-- Footer -->
  <footer id="footer">
    <div class="inner">
      <div class="container">
        <h2>Change Car Status to Out of Service</h2>
        <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
          <form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" name="plateId" class="form-control" id="plateId" placeholder="Plate Id" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="out_of_service_start_date">Out of service start date</label>
              <input type="date" name="out_of_service_start_date" class="form-control" id="cur_state" placeholder="out_of_service_start_date" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="out_of_service_end_date">Out of service end date</label>
              <input type="date" name="out_of_service_end_date" class="form-control" id="cur_state" placeholder="out_of_service_end_date">
            </div>
            <input type="submit" name="submit" class="btn btn-primary mb-2" value="Register" />
          </form>
        </div>
      </div>
    </div>
  </footer>

  </div>
  <?php
  $conn = $_SESSION['conn'];

  if (isset($_POST['submit'])) {

    $plate_id = $_POST['plateId'];
    $out_of_service_start_date = $_POST['out_of_service_start_date'];
    $out_of_service_end_date = $_POST['out_of_service_end_date'];
    $out_of_service = '1';

    $result = mysqli_query($conn, "SELECT * FROM `car_status` WHERE car_plate_id = '$plate_id' AND (('$out_of_service_start_date' between out_of_service_start_date and out_of_service_end_date) OR ('$out_of_service_end_date' between out_of_service_start_date and out_of_service_end_date) )");
    $car = mysqli_fetch_assoc($result);

    if ($car) { // if car exists
      echo '<script>';
      echo 'alert("Car already Out of Service!");';
      echo 'window.location = "car_status.php"';
      echo '</script>';
    } else {
      $query = "INSERT INTO `car_status` (car_plate_id,out_of_service_start_date,out_of_service_end_date) 
                    VALUES('$plate_id', '$out_of_service_start_date','$out_of_service_end_date')";
      
      $result = mysqli_query($conn, $query);
      $query = "UPDATE car SET out_of_service='1' WHERE car_plate_id='$plate_id'";
      $result = mysqli_query($conn, $query);

      echo '<script>';
      echo 'alert("Car Status entered successfully");';
      echo '</script>';
      /*
        $query1 = "INSERT INTO `car` (office_id) 
        VALUES('$office_id') where car_plate_id = '$plate_id'";
        $result1 = mysqli_query($conn, $query1);
        */
      echo '<script>';
      echo 'window.location = "admin_dashboard.php"';
      echo '</script>';
      exit();
    }
  }
  $conn->close();
  ?>
</body>

</html>