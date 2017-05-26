<?php
	require_once("connect.php");
	
	/* Starts a new session */
	if(!isset($_SESSION)){
		session_start();
	}
	
	/* Session goes through if username is correct
		Creates new variable for $user: gets username for that session
		Variable $loggedin must be true before you can go through
	*/
	if(isset($_SESSION['username'])) {
		$user = $_SESSION['username'];
		$loggedin = true;
	} else $loggedin = false;