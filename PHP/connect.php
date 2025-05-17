<?php
function connectDB(){
	//Creating variables.
	$servername="localhost";
	$username="userTest";
	$password="";
	$dbName="gameHost";
	
	//Creating connection with database.
	$conn=new mysqli($servername, $username, $password);

	//Checking connection state.
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error); //"->" work for acess other variable value.
	}

	if($conn->(query)$sql===TRUE){
		echo "Connection successfully";	
	}else{
		echo"Error creating database: " . $conn->error;
	}

	return $conn;
}

//Closing database connection.
function closeCon($conn){
	$conn->close();
}
?>
