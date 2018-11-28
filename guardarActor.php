<?php
	header('index.php');

	require_once('libreria.php');

	$q=new Queries();

	if(empty($q->dbc)){
		echo "Error en la conexion a MYSQL...";
		die();
	}

	$actores=$q->getActores(); //Se cargan los actores
	$cont=1;

	//Se calcula el ID que hay que asignar al actor
	foreach ($actores as $actor){
		if($cont<$actor['id']){
			break;
		}

		$cont++;
	}

	if(isset($_POST['add'])){ //Se ha recibido el valor de añadir
		//Se recibe la informacion del actor
		$actor['id']=$cont;	
		$actor['nombre']=$_POST['nombre'];
		$actor['n_tbb']=$_POST['n_tbb'];
		$actor['edad']=$_POST['edad'];
		$actor['sexo']=$_POST['sexo'];
		$actor['nacionalidad']=$_POST['nacionalidad']; 
		$actor['stcivil']=$_POST['stcivil']; 
		$actor['Otras_series']=$_POST['Otras_series']; 
		$actor['imagen']=$_POST['imagen'];
		$actor['coche']=$_POST['coche'];
		$actor['bici']=$_POST['bici'];
		$actor['moto']=$_POST['moto'];
		$actor['picaporte']=$_POST['picaporte']; 

		if(isset($_POST['id'])){
			$id=$_POST['deleteID'];
		}

		else{
		  $q->addActor($actor); //Se añade el actor a la base de datos
		  header('Location: indexlogin.php'); //Se vuelve a la pagina principal
		}
		
	}

	else if(isset($_POST['update'])){ //Se ha recibido el valor de actualizar
		$q->deleteActor($actor); //Se borra el actor de la base de datos
		
		//Se recibe la informacion del actor
		$actor['nombre']=$_POST['nombre'];
		$actor['n_tbb']=$_POST['n_tbb'];
		$actor['edad']=$_POST['edad'];
		$actor['sexo']=$_POST['sexo'];
		$actor['nacionalidad']=$_POST['nacionalidad']; 
		$actor['stcivil']=$_POST['stcivil']; 
		$actor['Otras_series']=$_POST['Otras_series']; 
		$actor['imagen']=$_POST['imagen'];
		$actor['coche']=$_POST['coche'];
		$actor['bici']=$_POST['bici'];
		$actor['moto']=$_POST['moto'];
		$actor['picaporte']=$_POST['picaporte']; 

		if(isset($_POST['id'])){
			$id=$_POST['deleteID'];
		}

		else{
			$q->addActor($actor); //Se añade el actor a la base de datos
			header('Location: indexlogin.php'); //Se vuelve a la pagina principal
		}
	}

	else{ //No se ha recibido ninguno de los valores anteriores
		header('Location: indexlogin.php'); //Se vuelve a la pagina principal
	}
?>