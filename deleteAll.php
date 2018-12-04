<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#F78181">
		<?php
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

echo <<< _END
	      	<div align=\"center\">¿Deseas borrar todos los actores?</div>

			<br>

			<!-- Formulario para borrar a los actores -->
			<center> <form method="post" action="borrarActor.php">
				<input type="hidden" name="deleteAll" value=true>
				<input type="submit" name="submitted" value="Aceptar"/>
				<input type="submit" name="submitted" value="Cancelar"/>
			</form> </center>
_END;
			}
		?>
	</body>
</html>