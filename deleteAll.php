<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#F78181">
		<?php
			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
				echo "Error en la conexion a MYSQL...";
				die();
			}

	      	echo "<div align=\"center\">¿Deseas borrar todos los actores?</div>";
		?>

		<br>

		<!-- Formulario para borrar a los actores -->
		<center> <form method="post" action="borrarActor.php">
			<input type="hidden" name="deleteAll" value=true>
			<input type="submit" name="submitted" value="Aceptar"/>
			<input type="submit" name="submitted" value="Cancelar"/>
		</form> </center>
	</body>
</html>