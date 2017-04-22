<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login12";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



/*
// $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  $name = test_input($_POST["name"]);
  //$email = $_POST["email"];
  $password = $_POST["pass1"];
  }

*/

$nameErr = $emailErr = $passErr= "";
$name = $email  = $password="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  
 if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }


 if (empty($_POST["phone"])) {
    $phoneErr = "Number is required";
  } else {
    $phone = test_input($_POST["phone"]);
  }

$password = $_POST["pass1"];
$password1 = $_POST["pass2"];
if (empty($password) or empty($password1) )
    print "Passwords are required";
 if ($password!=$password1)
  	print "Passwords do not match"; 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	



$sql = "INSERT INTO signup
 (email,password,phone)
VALUES ('$email','$password','$phone')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>