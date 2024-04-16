<?php


// session_start();

// // Destroy session
// session_destroy();

// // Redirect to login page
// header("Location: login.php");
// exit();


//Destroy Session and unset all session variables

session_start();
	session_unset();
	session_destroy();

    //Redirect to login page.
	header('Location: login.php');