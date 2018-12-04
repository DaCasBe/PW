<!DOCTYPE html>

<html lang="es">
	<?php
		require_once('libreria.php');

		if(isset($_POST['aumento'])){
			$nick_user=$_POST['nick'];
			$sueldo=$_POST['sueldo'];

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha podido establecer conexion con la base de datos
				echo "Error en la conexion a MySQL...";
				die();
			}

			$q->aumentarSueldo($nick_user,$sueldo);

			header('Location: indexlogin.php');
		}
	?>

 	<title>Lista reparto The Bing Ban Theory</title>

	<body bgcolor="A4A4A4">
		<?php
			$nick_user=$_GET['nick']; //Se recibe el ID del actor a mostrar

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
			
			$usuario=$q->getUserSessionInfo($nick_user); //Se carga la informacion del actor especificado

echo <<<_END
				<!-- Se muestra la informacion del usuario especificado -->
			 	<center> <img src= $usuario[imagen]></center>
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
_END;

				if($usuario['mas_sueldo']!=0){
echo <<< _END
					<center>$usuario[nick] ha pedido un aumento para obtener un sueldo de $usuario[mas_sueldo]. ¿Desea concederle el aumento?</center>

					<form method="post" action="usuario.php">
						<center>
							<input type="hidden" name="nick" value=$usuario[nick]>
							<input type="hidden" name="sueldo" value=$usuario[mas_sueldo]>
							<input type="submit" name="aumento" value=Aceptar>
							<button onclick="location.href='indexlogin.php'">Cancelar</button></center>
					</form>
_END;
				}

echo <<< _END
				<center><a href="indexlogin.php"><img src="menu.png" width="5%" height="5%"></a></center>
_END;
			}
		?>
	</body>
</html>