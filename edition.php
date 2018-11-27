<!DOCTYPE html>

<html lang="es">
	<body bgcolor="#819FF7">
		<?php
			$id=$_GET['id']; //Se recibe el ID del actor a modificar

			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
				echo "Error en la conexion a MYSQL...";
				die();
			}

			$actor=$q->getActor($id); //Se carga la informacion del actor a editar

			echo <<< _END
				<!-- Formulario para editar al actor -->
				<form method="post" action="guardarActor.php">
			  		<table align="center">
			  		 <tr>	
						<td>
							Nombre del actor
						</td>
						<td>
							<input type="text" name="nombre" value=$actor[nombre]>
						</td>
					 </tr>
					 <tr>
						<td>
							Nombre del personaje
						</td>
						<td>
							<input type="text" name="n_tbb" value=$actor[n_tbb]>
						</td>	
					 </tr>	
					 <tr>
						<td>
							Edad
						</td>
						<td>
							 <input type="text" name="edad" value=$actor[edad]>
						</td>		 
					 </tr>
					 <tr>
					 	<td>
					 		Sexo
					 	</td>
					 	<td>
_END;
							if(strnatcasecmp($actor['sexo'],"Hombre")==0){
			echo <<< _END
								<input type="radio" name="sexo" value="Hombre" checked>Hombre <br>
							 	<input type="radio" name="sexo" value="Mujer">Mujer <br>
							 	<input type="radio" name="sexo" value="Indefinido">Indefinido <br>
_END;
							}

							else if(strnatcasecmp($actor['sexo'],"Mujer")==0){
			echo <<< _END
								<input type="radio" name="sexo" value="Hombre">Hombre <br>
							 	<input type="radio" name="sexo" value="Mujer" checked>Mujer <br>
							 	<input type="radio" name="sexo" value="Indefinido">Indefinido <br>
_END;
							}

							else if(strnatcasecmp($actor['sexo'],"Indefinido")==0){
			echo <<< _END
								<input type="radio" name="sexo" value="Hombre">Hombre <br>
							 	<input type="radio" name="sexo" value="Mujer">Mujer <br>
							 	<input type="radio" name="sexo" value="Indefinido" checked>Indefinido <br>
_END;
							}

							else{
			echo <<< _END
								<input type="radio" name="sexo" value="Hombre">Hombre <br>
							 	<input type="radio" name="sexo" value="Mujer">Mujer <br>
							 	<input type="radio" name="sexo" value="Indefinido">Indefinido <br>
_END;
							}

			echo <<< _END
					 	</td>
					 </tr>
					 <tr>	
						<td>
							Nacionalidad
						</td>
						<td>
							<input type="text" name="nacionalidad" value=$actor[nacionalidad]>
						</td>	
					 </tr>	
					 <tr>
						<td>
							Estado civil
						</td>
						<td>
_END;
							if(strnatcasecmp($actor['stcivil'],"Casado/a")==0){
			echo <<< _END
								<input type="radio" name="stcivil" value="Casado/a" checked>Casado/a <br>
								<input type="radio" name="stcivil" value="Soltero/a">Soltero/a <br>
								<input type="radio" name="stcivil" value="Viudo/a">Viudo/a
_END;
							}

							else if(strnatcasecmp($actor['stcivil'],"Soltero/a")==0){
			echo <<< _END
								<input type="radio" name="stcivil" value="Casado/a">Casado/a <br>
								<input type="radio" name="stcivil" value="Soltero/a" checked>Soltero/a <br>
								<input type="radio" name="stcivil" value="Viudo/a">Viudo/a
_END;
							}

							else if(strnatcasecmp($actor['stcivil'],"Viudo/a")==0){
			echo <<< _END
								<input type="radio" name="stcivil" value="Casado/a">Casado/a <br>
								<input type="radio" name="stcivil" value="Soltero/a">Soltero/a <br>
								<input type="radio" name="stcivil" value="Viudo/a" checked>Viudo/a
_END;
							}

							else{
			echo <<< _END
								<input type="radio" name="stcivil" value="Casado/a">Casado/a <br>
								<input type="radio" name="stcivil" value="Soltero/a">Soltero/a <br>
								<input type="radio" name="stcivil" value="Viudo/a">Viudo/a
_END;
							}

			echo <<< _END
						</td>	
					 </tr>	
					 <tr>
		 				<td>
		 					Otras series
		 				</td>
		 				<td>
		 					<input type="text" name="Otras_series" value=$actor[Otras_series]>
		 				</td>
		 			</tr>
		 			<tr>
						<td>
							Vehiculos
						</td>
						<td>
_END;

							if($actor['coche']==1){
			echo <<< _END
								<input type="checkbox" name="coche" value="1" checked>Coche <br>
_END;
							}

							else{
			echo <<< _END
								<input type="checkbox" name="coche" value="0">Coche <br>
_END;
							}
							
							if($actor['bici']==1){
			echo <<< _END
								<input type="checkbox" name="bici" value="1" checked>Bici <br>
_END;
							}

							else{
			echo <<< _END
								<input type="checkbox" name="bici" value="0">Bici <br>
_END;
							}

							if($actor['moto']==1){
			echo <<< _END
								<input type="checkbox" name="moto" value="1" checked>Moto <br>
_END;
							}

							else{
			echo <<< _END
								<input type="checkbox" name="moto" value="0">Moto <br>
_END;
							}

							if($actor['picaporte']==1){
			echo <<< _END
								<input type="checkbox" name="picaporte" value="1" checked>Picaporte <br>
_END;
							}

							else{
			echo <<< _END
								<input type="checkbox" name="picaporte" value="0">Picaporte <br>
_END;
							}

			echo <<< _END
						</td>	
				 	</tr>
		 			 <tr>	
						<td>
							Imagen
						</td>	
						<td>
								<input type="file" name="imagen" value=$actor[imagen]>
						</td>
					 </tr>	
					</table>
_END;
		?>

					<br>

					<center><input type="hidden" value= "<?php echo $id; ?>" /></center>
					<center><input type="submit" name="update" value="Submit"/></center>

					<br>

					<center><input type="reset"/></center>
				</form>

				<br>

				<center><button onclick="location.href='index.php'">Cancelar</button></center>
	</body>
</html>		