<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#F78181">
		<?php
			$id=$_GET['id']; //Se recibe el ID del actor a borrar
		
			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
				echo "Error en la conexion a MYSQL...";
				die();
			}
			
			$actor=$q->getActor($id); //Se carga la informacion del actor a borrar

	      	echo "<div align=\"center\">¿Deseas borrar al actor $actor[nombre]?</div>";
		?>

		<br>

		<!-- Formulario para borrar al actor -->
		<center> <form method="post" action="borrarActor.php">
			<input type="hidden" name="delete" value=true>
			<input type="hidden" name="deleteID" value= "<?php echo $id; ?>">
			<input type="submit" name="submitted" value="Aceptar"/>
			<input type="submit" name="submitted" value="Cancelar"/>
		</form> </center>
	</body>
</html>