<?php
	require_once('libreria.php');

	$q=new Queries();

	if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
		echo "Error en la conexion a MYSQL...";
		die();
	}

	if(isset($_POST['deleteID'])){
		$id=$_POST['deleteID'];
	}

	else{
		header('Location: index.php'); //Se vuelve a la pagina principal
	}

	if (isset($_POST['delete'])){
		if(strnatcasecmp( $_POST['submitted'],"Cancelar")==0){
			header('Location: index.php'); //Se vuelve a la pagina principal
		}

		else{
			$q->deleteActor($id); //Se borra el actor de la base de datos
			header('Location: index.php'); //Se vuelve a la pagina principal
		}
	}
?>