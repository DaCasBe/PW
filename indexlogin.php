<!DOCTYPE html>

<html lang="es">
	<title> Reparto de The Big Ban Theory </title>

	<body bgcolor="#70d989">
		<div align="right"><a href="index.php">logout</a></div>

		<center> <img src="osac.png"> </center> <!-- Imagen de la OSAC -->

		<?php
			require_once('libreria.php');
			require_once('session.php');

			$q=new Queries();

			if(empty($q->dbc)){ //No se ha establecido la conexion con MySQL
				echo "Error: no se ha podido establecer la conexion con MySQL";
				die();
			}

			if($logged){ //de lo del maestro
			    echo "Está logeado como $nick";
			}

			if($admin){
			    echo " y es administrador";
			}

echo <<<_END
				<h1 align="center">Listado de actores</h1>

				<!-- Tabla de actores -->
				<table align="center">
					<tr>
						<th>Nombre en la serie</th>
						<th>Edad</th>
						<th>Nacionalidad</th>
_END;
						if($admin){
							echo "<th>Opciones</th>";
						}

					echo "</tr>";

			$actores=$q->getActores();

			foreach ($actores as $actor){ //Se muestran todos los actores
echo <<<_END
					<tr>
						<td> <a href="plantilla.php?id=$actor[id]"> $actor[n_tbb] </a> </td>
						<td> $actor[edad] </td>
						<td> $actor[nacionalidad] </td>
_END;

						if($admin){
echo <<< _END
						<td align="center"><a href="delete.php?id=$actor[id]"><img src="delete.png" width="5%" height="5%"></a><a href="edition.php?id=$actor[id]"><img src="edition.png" width="5%" height="5%"></a></td>
_END;
						}

					echo "</tr>";
			}

				echo "</table>";

				if($admin){
echo <<< _END
					<center><a href="add.php"><img src="OK-512.png" width="5%" height="5%"></a> <a href="deleteAll.php"><img src="borrar.png" width="5%" height="5%"></a> </center>
_END;
				}

				if($admin){
echo <<< _END
					<hr width=60% align="center"> 

					<h1 align="center">Listado de usuarios</h1>

					<!-- Tabla de actores -->
					<table align="center">
						<tr>
							<th>Nick</th>
							<th>E-mail</th>
							<th>Administrador</th>
							<th>Opciones</th>
						</tr>
_END;
					$usuarios=$q->getUsuarios();

					foreach ($usuarios as $usuario){
echo <<<_END
						<tr>
							<td> <a href="usuario.php?nick=$usuario[nick]"> $usuario[nick] </a> </td>
							<td> $usuario[email] </td>
							<td> $usuario[admin] </td>
							<td align="center"><a href="delete.php?nick=$usuario[nick]"><img src="delete.png" width="5%" height="5%"></a><a href="edition.php?id=$usuario[nick]"><img src="edition.png" width="5%" height="5%"></a></td>
						</tr>
_END;
					}

					echo "</table>";
				}
		?>
	</body>
</html>