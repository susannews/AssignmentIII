<!-- Susanne Stenshagen, Silje Lien, Espen Kalstad -->
<?php 

$host = 'localhost';
$user = 'root';
$pass = 'dbpassord'; /* Remember to edit to your password */
$db = 'oppgave3';


/* Creates new pdo and connects with PDO API */
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>