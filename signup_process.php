<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$conn = new mysqli($servername, $username, $password, $dbname,"3307");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  $ssn = $_POST['ssn'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $passwordd = $_POST['password'];
  $age = $_POST['age'];
  $gender = $_POST["gender"];
  $phone = $_POST["phone"];

  $sql = "INSERT INTO users (ssn,fname,lname,email,password,age,gender,phone) VALUES ('$ssn','$fname','$lname','$email','$passwordd','$age','$gender','$phone')";
/*<!--INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100141','Ahmed','Falah','falah@gmail.com','falah',21,'M','01010101013'); -->*/


  $select = mysqli_query($conn, "SELECT * FROM users WHERE email =\"" . $_POST["email"] . "\"" );
  $select1 = mysqli_query($conn, "SELECT * FROM users WHERE phone = " . $_POST["phone"]);
  $select2 = mysqli_query($conn, "SELECT * FROM users WHERE ssn = " . $_POST["ssn"] );
  if (mysqli_num_rows($select2)) {
    echo "<script>";
    echo "alert('National ID Already Exists!');" ;
    echo "</script>";
    echo '<script>';
    echo 'window.location = "signup.php"';
    echo '</script>';
  }
  else if (mysqli_num_rows($select)) {
    echo "<script>";
    echo "alert('Email Already Exists!');" ;
    echo "</script>";
    echo '<script>';
    echo 'window.location = "signup.php"';
    echo '</script>';
  }
  else if (mysqli_num_rows($select1)) {
    echo "<script>";
    echo "alert('Phone Number Already Exists!');" ;
    echo "</script>";
    echo '<script>';
    echo 'window.location = "signup.php"';
    echo '</script>';
  }
  else {
    mysqli_query($conn,$sql);
    echo '<script>';
    echo 'window.location = "index.php"';
    echo '</script>';
  
  }  $conn->close();
