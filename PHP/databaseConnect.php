<?php
function connect(){
	//Creating variables.
	$dsn="mysql:host=localhost;dbname=hospedagem_jogos;charset=utf8mb4"; //Connection string, stores database informations to easily.
	$username='userTest';
	$password='1234';

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
		die("Conection error with database: " . $errorMessage->getMessage());
	}

//Closing database connection. PDO close connection when the php code block reaches the end, but for manual closed, this function is here.
function disconnect(){
	$pdo=null;
}
?>
