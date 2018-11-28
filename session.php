<?php
    session_start();

    if(isset($_SESSION['nick'])){
        $logged=true;
        $nick=$_SESSION['nick'];
        $email=$_SESSION['email'];
        $admin=$_SESSION['admin'];
    }

	else{
		$logged=false;
	}
?>