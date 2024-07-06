<?php
$servename="localhost";
// usere name for mysql database
$username="root";
// password for databasse
$password="Sidharth@123";
$dbname="prince-tailors";
$conn=new mysqli($servename , $username,$password,$dbname);
if($conn->connect_error){
    die($conn->connect_error);
}

// $servename="localhost";
// // usere name for mysql database
// $username="sharma";
// // password for databasse
// $password="Sharma@123";
// $dbname="sharma";
// $conn=new mysqli($servename , $username,$password,$dbname);
// if($conn->connect_error){
//     die($conn->connect_error);
// }


?>