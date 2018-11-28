<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#82FA58">
		<?php
			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
				echo "Error en la conexion a MYSQL...";
				die();
			}
		?>

		<!-- Formulario para añadir un actor -->
		<form method="post" action="guardarActor.php">
	  		<table align="center">
	  		 <tr>	
				<td>
					Nombre del actor
				</td>
				<td>
					<input type="text" name="nombre">
				</td>
			 </tr>
			 <tr>
				<td>
					Nombre del personaje
				</td>
				<td>
					<input type="text" name="n_tbb">
				</td>	
			 </tr>	
			 <tr>
				<td>
					Edad
				</td>
				<td>
					 <input type="text" name="edad">
				</td>		 
			 </tr>
			 <tr>
			 	<td>
			 		Sexo
			 	</td>
			 	<td>
			 		<input type="radio" name="sexo" value="Hombre">Hombre <br>
			 		<input type="radio" name="sexo" value="Mujer">Mujer <br>
			 		<input type="radio" name="sexo" value="Indefinido">Indefinido <br>
			 	</td>
			 </tr>
			 <tr>	
				<td>
					Nacionalidad
				</td>
				<td>
					<input type="text" name="nacionalidad">
				</td>	
			 </tr>	
			 <tr>
				<td>
					Estado civil
				</td>
				<td>
					<input type="radio" name="stcivil" value="Casado/a">Casado/a <br>
					<input type="radio" name="stcivil" value="Soltero/a">Soltero/a <br>
					<input type="radio" name="stcivil" value="Viudo/a">Viudo/a
				</td>	
			 </tr>	
			 <tr>
 				<td>
 					Otras series
 				</td>
 				<td>
 					<input type="text" name="Otras_series">
 				</td>
 			</tr>
 			<tr>
				<td>
					Vehiculos
				</td>
				<td>
					<input type="checkbox" name="coche" value="1">Coche <br>
					<input type="checkbox" name="bici" value="1">Bici <br>
					<input type="checkbox" name="moto" value="1">Moto <br>
					<input type="checkbox" name="picaporte" value="1">Picaporte
				</td>	
			 </tr>	
 			 <tr>	
				<td>
					Imagen
				</td>	
				<td>
						<input type="file" name="imagen">
				</td>
			 </tr>	
			
			
			</table>
			<br>
			<center><input type="submit" name="add" value="Submit"/></center>
			<br>
			<center><input type="reset" /></center>
		</form>

		<br>
		
		<center><button onclick="location.href='indexlogin.php'">Cancelar</button></center>
	</body>
</html>