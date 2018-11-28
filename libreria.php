<?php

	class Queries{
		public $usuario='Daniel';  //Nombre de usuario
		public $password='KASOLCoD97'; //Contraseña
		public $dbc; //Objeto de conexion con la base de datos

		//Funcion para conectarse con la base de datos
		public function __construct(){
			$this->dbc=$this->dbconnect(); //Se establece la conexion con la base de datos
		}

		//Funcion para establecer la conexion con la base de datos
		public function dbconnect(){
			$dbc=null; //Se establece el objeto de conexion sin ninguna conexion

			try{ //Se trata de establecer la conexion con la base de datos
				$dbc=new PDO('mysql:host=localhost; dbname=osac',$this->usuario,$this->password,array(PDO::ATTR_PERSISTENT => true));
			}catch(PDOException $e){
				return null;
			}

			return $dbc;
		}

		//Funcion para cargar todos los actores
		public function getActores(){
			$actores=array();
			$i=0;

			$sentence=$this->dbc->prepare("SELECT * FROM actor"); //Se establece la sentencia especificada

			if($sentence->execute()){ //Se ejecuta la sentencia anterior
				while($row=$sentence->fetch()){
					$actores[$i]=$row; //Se carga el actor
					$i++;
				}
			}
			
			return $actores;
		}

		//Funcion para cargar un actor
		public function getActor($id){
			$sentence=$this->dbc->prepare("SELECT * FROM actor WHERE id=$id"); //Se establece la sentencia especificada

			if($sentence->execute()){ //Se ejecuta la sentencia anterior
				$act=$sentence->fetch();
			}

			return $act;
		}

		//Funcion para añadir un actor a la base de datos
		public function addActor($actor){
			$sentence=$this->dbc->prepare("INSERT INTO actor(id, nombre, n_tbb, edad,sexo, nacionalidad, stcivil, Otras_series, imagen, coche, bici, moto, picaporte) VALUES('$actor[id]', '$actor[nombre]', '$actor[n_tbb]', '$actor[edad]','$actor[sexo]', '$actor[nacionalidad]','$actor[stcivil]', '$actor[Otras_series]', '$actor[imagen]', '$actor[coche]', '$actor[bici]', '$actor[moto]','$actor[picaporte]')"); //Se establece la sentencia especificada
			
			$sentence->execute(); //Se ejecuta la sentencia anterior

			return;
		}

		//Funcion para borrar una actor de la base de datos
		public function deleteActor($actor){
			$sentence=$this->dbc->prepare("DELETE FROM actor WHERE id=$actor[id]"); //Se establece la sentencia especificada

			$sentence->execute(); //Se ejecuta la sentencia anterior

			return;
		}

		//Funcion para actualizar un actor de la base de datos
		public function updateActor($actor){
			$sentence=$this->dbc->prepare("UPDATE actor SET * WHERE id=$actor[id]"); //Se establece la sentencia especificada

			$sentence->execute(); //Se ejecuta la sentencia anterior
		}

		public function checkUserAndPassword($nick,$password){
			$sentence=$this->dbc->prepare("SELECT * FROM user WHERE nick='$nick' AND password='$password'");

			if($sentence->execute()){
				return true;
			}

			return false;
		}

		public function getUserSessionInfo($username){
			$sentence=$this->dbc->prepare("SELECT * FROM user WHERE nick='$username'");

			if($sentence->execute()){
				$user=$sentence->fetch();
			}

			return $user;
		}

		public function checkNewUser($user){
			$sentence=$this->dbc->prepare("SELECT * FROM user WHERE nick=$user[nick]");

			if($sentence->execute()){
				return false;
			}

			if($user['nick']==""){ 
                return false;
            }

            if($user['password']==""){ 
                return false;
            }

            if($user['password']!=$user['confirmPassword']){ 
                return false;
            }

            if($user['nombre']==""){ 
                return false;
            }

            if($user['email']==""){ 
                return false;
            }

			return true;
		}

		public function addUser($newUser){
			$sentence=$this->dbc->prepare("INSERT INTO user(nick,password,nombre,apellidos,email,telefono) VALUES('$newUser[nick]','$newUser[password]','$newUser[nombre]','$newUser[apellidos]','$newUser[email]','$newUser[telefono]')");

			if($sentence->execute()){
				return true;
			}

			return false;
		}

		public function esAdmin($nick){
			$sentence=$this->dbc->prepare("SELECT admin FROM user WHERE nick=$nick AND admin=1");

			if($sentence->execute()){
				return true;
			}

			return false;
		}

		public function getUsuarios(){
			$usuarios=array();
			$i=0;

			$sentence=$this->dbc->prepare("SELECT * FROM user"); //Se establece la sentencia especificada

			if($sentence->execute()){ //Se ejecuta la sentencia anterior
				while($row=$sentence->fetch()){
					$usuarios[$i]=$row; //Se carga el actor
					$i++;
				}
			}
			
			return $usuarios;
		}
	}
?>