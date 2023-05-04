<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS book_form (
id int(30) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(30) COLLATE latin1_bin,
name VARCHAR(30),
email VARCHAR(30),
phone VARCHAR(30),
address VARCHAR(30),
location VARCHAR(30),
guests INT(30),
arrivals DATE,
leaving DATE,
ptype VARCHAR(30)
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
<?php

   $connection = mysqli_connect('localhost','root','','book_db');

   if(isset($_POST['send'])){
      $username=$_SESSION['username'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $location = $_POST['location'];
      $guests = $_POST['guests'];
      $arrivals = $_POST['arrivals'];
      $leaving = $_POST['leaving'];
      $ptype = $_POST['ptype'];

      //echo "$username";

      $request = " insert into book_form(username, name, email, phone, address, location, guests, arrivals, leaving, ptype) values('$username','$name','$email','$phone','$address','$location','$guests','$arrivals','$leaving','$ptype') ";
      mysqli_query($connection, $request);

      $int =(int) filter_var($location , FILTER_SANITIZE_NUMBER_INT);

      if($ptype=="economic")
      {
         $cost= $int*100*10*$guests;
         // echo "$cost";
      }
      else if($ptype=="semi-deluxe")
      {
         $cost= $int*100*20*$guests;
         // echo "$cost";
      }
      else{
         $cost= $int*100*30*$guests;
         // echo "$cost"; 
      }

      $_SESSION["cost"]=$cost;
      $_SESSION["name2"]=$name;
      $_SESSION["trans"]="false";
      $_SESSION["error"]=NULL;

      header('location:transaction.php'); 

   }else{
      echo 'something went wrong please try again!';
   }

?>