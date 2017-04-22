<!doctype html>
<html>
<head>
<title>Signup</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>

.error {
color: #FF0000;
}

#wrapper {
width:600px;
margin:0 auto;
font-family: helvetica;
font-size:1.2em;
}
input {
width:400px;
height:30px;
padding:5px;
border-radius:5px;
font-size:1.2em;
border: 1px solid grey;
margin-bottom:10px;
}
label {
width:200px;
float:left;
padding-top:7px;
}
#submitButton {
height:50px;
margin-left:200px;
width:100px;
}
#error {
color:red;
}
</style>
</head>

<body>


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

$nameErr = $emailErr = $passErr=$phoneErr= "";
$name = $email  = $password=$password1= $phone= $enc_pwd="";

$rd=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = test_input($_POST["name"]);
$email = test_input($_POST["email"]);
$phone=test_input($_POST["phone"]);
$password = test_input($_POST["pass1"]);
$password1 = test_input($_POST["pass2"]);
if($password==$password1)
{
  $enc_pwd=md5($password);
$sql = "INSERT INTO signup (name,email,password,phone) VALUES ('$name','$email','$enc_pwd','$phone')";
if ($conn->query($sql) === TRUE) {
    echo "Success";
  header("Location: tryit.php");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}
else
{
    echo "Incorrect Password";
  //header("Location: http://www.example.com/");
}


/*
   if (empty($_POST["name"])) {
  $rd=1;    
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
      $rd=1;
    }
  }
  

 if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $rd=1;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
      $rd=1;
    }
  }


 if (empty($_POST["phone"])) {
    $phoneErr = "Number is required";
    $rd=1;
  } else {
    $phone = test_input($_POST["phone"]);
  }

$password = $_POST['pass1'];
$password1 = $_POST['pass2'];
$enc_pwd=md5($password);
//$password = test_input($_POST["pass1"]);
//$password1 = test_input($_POST["pass2"]);
if(empty($password) or empty($password1))
  {
    $passErr= "Password is required"; 
    $rd=1;
  }   
 if($password!=$password1)
 {
    $passErr="Passwords do not match"; 
    $rd=1;
  } 
  */
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 


?>


<div id="wrapper">
<div id="error"></div>

<form id="validationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >

<label for="name">Name</label>

<input name="name" id="name"  />
  <span class="error">* <?php echo $nameErr;?></span>



<label for="email">Email</label>

<input name="email" id="email" type="email" />
  <span class="error">* <?php echo $emailErr;?></span>


<label for="pass1">Password</label>
<input name="pass1" type="password" id="pass1"   />
<span class="error">* <?php echo $passErr;?></span>

<label for="pass2">Confirm Password</label>
<input name="pass2" type="password" id="pass2" />
<span class="error">* <?php echo $passErr;?></span>


<label for="phone">Telephone</label>
<input name="phone" id="phone" />
<span class="error">* <?php echo $phoneErr;?></span>

<input id="submitButton" type="submit" value="Submit" />
</form>
</div>
<!--
<script>
$("#validationForm").submit(function(event) {
var errorMessage="";
event.preventDefault();
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
if (!isValidEmailAddress($("#email").val())) {
errorMessage="<br />Please enter a valid email address";
}
if (!$.isNumeric($("#phone").val())) {
errorMessage=errorMessage+"<br />Please enter a valid phone number";
}
if ($("#pass1").val() != $("#pass2").val()) {
errorMessage=errorMessage+"<br />Please enter matching passwords";
}
if (errorMessage=="") {
alert("Success!");

} else {

}
});
</script>
-->





</body>
</html>