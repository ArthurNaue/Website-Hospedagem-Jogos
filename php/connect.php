<?php
function connect_db(){
	//Setting connection variables.
	$dsn="mysql:host=localhost;dbname=hospedagem_jogos;charset=utf8mb4";	
	$username='root';
	$password='';

	//Try connection with database.
	try{
		//Creating a new PDO instance.
		$pdo=new PDO($dsn,$username,$password,[
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, //Launch exceptions in error case.
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, //When we use SELECT, for example, the data return:['column'=>value].
			PDO::ATTR_EMULATE_PREPARES=>false //Use real prepares of MySql, more secure, avoid sqlInjection.
		]);

		return $pdo;

	//If 'try' fail, kill connection and show the error.
	} catch(PDOException $errorMessage){ //PDOException it's a error class, this argument catch the error, it's like true/false.
		die("Connection error with database: " . $errorMessage->getMessage());
	}
}
?>