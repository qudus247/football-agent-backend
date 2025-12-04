<?php 
$servername = "localhost";
$usernmae = "root";
$password = "";
$db_name = "talentbridge_agency";


// conn
$conn = new mysqli($servername, $usernmae, $password, $db_name);

//check conn
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);

}
?>