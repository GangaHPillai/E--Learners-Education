<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$comment = $_POST['comment'];

if (!empty($name) || !empty($email) || !empty($subject) || !empty($comment)) {
 $host = "localhost";
    $dbname = "root";
    $dbemail = "";
    $dbname = "test";
    
    //create connection
    $conn = new mysqli($host, $dbname, $dbemail, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From registration Where email = ? Limit 1";
     $INSERT = "INSERT Into registration (name, email, subject, comment) values(?, ?, ?, ?)";

     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $name, $email, $subject, $comment);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>