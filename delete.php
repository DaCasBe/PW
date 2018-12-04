<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#F78181">
		<?php
			$id=$_GET['id']; //Se recibe el ID del actor a borrar
		
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
				
				$actor=$q->getActor($id); //Se carga la informacion del actor a borrar

echo <<< _END
		      	<div align=\"center\">¿Deseas borrar al actor $actor[nombre]?</div>

				<br>

				<!-- Formulario para borrar al actor -->
				<center> <form method="post" action="borrarActor.php">
					<input type="hidden" name="delete" value=true>
					<input type="hidden" name="deleteID" value=$id>
					<input type="submit" name="submitted" value="Aceptar"/>
					<input type="submit" name="submitted" value="Cancelar"/>
				</form> </center>
_END;
			}
		?>
	</body>
</html>