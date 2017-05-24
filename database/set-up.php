<!-- Susanne Stenshagen, studentnr: 470598 -->
<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = '';
	
	/* Creates new pdo and connects with PDO API */
	$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	
	/* Creates the database for the newspaper */
	$query = 'CREATE DATABASE IF NOT EXISTS oppgave3'; 
	$result = $pdo->prepare($query);
	$result->execute();
	
	/* Selects the database */
	$pdo->query("use oppgave3") or die('Can not select database');
	
	/* Creates a user and grant access */
	$query = "GRANT ALL ON oppgave3 TO 'admin'@'localhost' IDENTIFIED BY 'password'";
	$result = $pdo->prepare($query);
	$result->execute() or die('Query failed');
	
	/* The script for database setup from textfile */
	$query = file_get_contents("setup.txt");
	$result = $pdo->prepare($query);
	
	/* If the tables are created, redirect to indexpage */
	if($result->execute()){ 
		header("location: ../");
	} else {
		echo "Fail to create tables";
	}
	
	
	/* Closes the PDO connection */
	$pdo = null; 
?> 