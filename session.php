<?php
    session_start();

    if(isset($_SESSION['nick'])){
        $logged=true;
        $nick=$_SESSION['nick'];
        $nombre=$_SESSION['nombre'];
        $admin=$_SESSION['admin'];
    }

	else{
		$logged=false;
	}
?>