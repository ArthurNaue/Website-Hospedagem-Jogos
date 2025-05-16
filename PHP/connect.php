<?php
//Creating variables.
$servername="localhost";
$username="userTest";
$password="pswd";

//Creating connection with database.
$conn=new mysqli($servername, $username, $password);

//Checking connection state.
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error); //"->" work for acess values of other variable.
}

//Creating database.
$sql="CREATE DATABASE myproject"
if($conn->(query)$sql===TRUE){
	echo "Connection successfully";	
}else{
	echo"Error creating database: " . $conn->error;
}

//Closing database connection.
$conn->close();
?>
