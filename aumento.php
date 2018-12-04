<!DOCTYPE html>

<html lang="es">
	<?php
	require_once('libreria.php');

		if(isset($_POST['aumento'])){
			if(strnatcasecmp($_POST['submitted'],"Cancelar")==0){
			   header('Location: indexlogin.php');
			}

			else{
				$nick=$_POST['nick'];

				if(isset($_POST['aumento'])){
					$sueldo=$_POST['dinero'];

					$q=new Queries();		

					if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
						echo "Error en la conexion a MYSQL...";
						die();
					}
					
					$user=$q->pedirAumento($nick,$sueldo);
					header('Location: indexlogin.php');
				}

				header('Location: indexlogin.php');
			}
		}
	?>
	<body bgcolor="#F78181">
		<?php
			$nick=$_GET['nick']; //Se recibe el ID del actor a borrar
		
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

				if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
					echo "Error en la conexion a MYSQL...";
					die();
				}
				
				$user=$q->getUserSessionInfo($nick); //Se carga la informacion del actor a borrar

echo <<< _END
		      	<div align=\"center\">¿Cuanto kres merecer cobrar?</div>
				<br>

				<!-- Formulario para borrar al actor -->
				<center> <form method="post" action="aumento.php">
					<input type="text" name="dinero">	
					<input type="hidden" name="aumento" value=true>
					<input type="hidden" name="nick" value=$nick>
					<input type="submit" name="submitted" value="Aceptar"/>
					<input type="submit" name="submitted" value="Cancelar"/>
				</form> </center>
_END;
			}
		?>
	</body>
</html>