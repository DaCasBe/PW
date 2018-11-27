<!DOCTYPE html>

<html lang="es">
	<title> Reparto de The Big Ban Theory</title>

	<body bgcolor="#70d989">
		<div align="right"><a href="authenticate.php">login</a></div>

		<center> <img src="osac.png"> </center>

		<?php
			require_once('libreria.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con MySQL
				echo "Error: no se ha podido establecer la conexion con MySQL";
				die();
			}

echo <<<_END
				<h1 align="center">Listado de actores</h1>

				<table align="center">
					<tr>
						<th>Nombre en la serie</th>
						<th>Edad</th>
						<th>Nacionalidad</th>
					</tr>
_END;

			$actores=$q->getActores();
			
			foreach ($actores as $actor){
echo <<<_END
					<tr>
						<td> $actor[n_tbb] </a> </td>
						<td> $actor[edad] </td>
						<td> $actor[nacionalidad] </td>
						</td>
					</tr>
_END;
			}
		?>
				</table>
	</body>
</html>