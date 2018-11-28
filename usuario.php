<!DOCTYPE html>

<html lang="es">
 	<title>Lista reparto The Bing Ban Theory</title>

	<body bgcolor="A4A4A4">
		<?php
			$nick=$_GET['nick']; //Se recibe el ID del actor a mostrar

			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha podido establecer conexion con la base de datos
				echo "Error en la conexion a MySQL...";
				die();
			}
			
			$usuario=$q->getUserSessionInfo($nick); //Se carga la informacion del actor especificado

			echo <<<_END
				<!-- Se muestra la informacion del usuario especificado -->
			 	<center> <img src= $usuario[imagen] ></center>
			 	<table align="center" border="4" bordercolor="#F9F9F6" bgcolor="#467DEC" width="570">
					<tr>
						<th colspan="2">Datos Personales</th>
					</tr>
					<tr>													
						<td>Nick del usuario:</td>
						<td>$usuario[nick] </td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td>$usuario[nombre] </td>
					</tr>
					<tr>
						<td>Apellidos:</td>
						<td>$usuario[apellidos] </td>
					</tr>
					<tr>
						<td>Sexo:</td>
						<td>$usuario[sexo]</td>
					</tr>
					<tr>
						<td>E-mail:</td>  
						<td>$usuario[email] </td>
					</tr>
					<tr>
						<td>Telefono:</td>  
						<td>$usuario[telefono] </td>				
					</tr>
					<tr>
						<td>Hobbies:(Beber/Chupar tizas/Otras)</td>
						<td>$usuario[beber] $usuario[tiza] $usuario[otras]</td>
					</tr>
					<tr>
						<td>Administrador:</td>  
						<td>$usuario[admin] </td>				
					</tr>
				</table> 

				<center><a href="indexlogin.php"><img src="menu.png" width="5%" height="5%"></a></center>
_END;
		?>
	</body>
</html>