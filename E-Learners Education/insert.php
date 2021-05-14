<?php
$day1 = $_POST['day1'];
$day2 = $_POST['day2'];
$timemap = $_POST['timemap'];
$totalhour = $_POST['totalhour'];
$Hour = $_POST['Hour'];
if (!empty($day1) || !empty($day2) || !empty($timemap) || !empty($totalhour) || !empty($Hour)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "timeschedule";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT totalhour From register Where totalhour = ? Limit 1";
     $INSERT = "INSERT Into register (day1, day2, timemap, totalhour, Hour, phone) values(?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $totalhour);
     $stmt->execute();
     $stmt->bind_result($totalhour);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssii", $day1, $day2, $timemap, $totalhour, $Hour);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this totalhour";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>