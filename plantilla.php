<!DOCTYPE html>

<html lang="es">
 	<title>Lista reparto The Bing Ban Theory</title>

	<body bgcolor="A4A4A4">
		<?php
			$id=$_GET['id']; //Se recibe el ID del actor a mostrar

			require_once('libreria.php');
			require_once('session.php');

			$now=time();

			if($now>$_SESSION['expire']){
				session_destroy();

echo <<< _END
					<div align="center" class='alert alert-danger' role='alert'>
						<h4> La sesión ha expirado </h4>
						<p> <a href='authenticate.php'> Accede aqui</a></p>
					</div>
_END;
			}

			else{
			$q=new Queries();

			if(empty($q->dbc)){ //No se ha podido establecer conexion con la base de datos
				echo "Error en la conexion a MySQL...";
				die();
			}
			
			$actor=$q->getActor($id); //Se carga la informacion del actor especificado

			echo <<<_END
				<!-- Se muestra la informacion del actor especificado -->
			 	<center> <img src= $actor[imagen] ></center>
			 	<table align="center" border="4" bordercolor="#F9F9F6" bgcolor="#467DEC" width="570">
					<tr>
						<th colspan="2">Datos Personales</th>
					</tr>
					<tr>													
						<td>Nombre del personaje:</td>
						<td>$actor[n_tbb] </td>
					</tr>
					<tr>													
						<td>Nombre completo:</td>
						<td>$actor[nombre] </td>
					</tr>
					<tr>
						<td>Edad:</td>  
						<td>$actor[edad] </td>
					</tr>
					<tr>
						<td>Sexo:</td>
						<td>$actor[sexo]</td>
					</tr>
					<tr>
						<td>Nacionalidad:</td>  
						<td>$actor[nacionalidad] </td>				
					</tr>
					<tr>
						<td>Estado civil:</td>  
						<td>$actor[stcivil] </td>				
					</tr>
					<tr>
						<td>Otras series:</td>  
						<td>$actor[Otras_series] </td>
					</tr>
					<tr>
						<td>Vehiculos:(Coche/Bici/Moto/Picaporte)</td>
						<td>$actor[coche] $actor[bici] $actor[moto] $actor[picaporte]</td>
					</tr>
				</table> 

				<center><a href="indexlogin.php"><img src="menu.png" width="5%" height="5%"></a></center>
_END;
			}
		?>
	</body>
</html>