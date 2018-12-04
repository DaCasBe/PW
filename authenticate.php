<?php
    require_once('libreria.php');
    //require_once('session.php');

    //Funcion para loguearse en el sistema
    function login($nick,$password){
        if(strlen($nick)<=0){
            return false;
        }

        if(strlen($password)<=0){
            return false;
        }

        $q=new Queries();

        if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
            echo "<h3 align='center'> Error: no se pudo establecer la conexión con la base de datos. </h3> <br/>";
            die();
        }

        $checkUser=$q->checkUserAndPassword($nick,$password); //Se comprueba si el usuario y la contraseña son correctos

        if($checkUser){ //El usuario o la contraseña son correctos
            session_start();

            $userSessionInfo=$q->getUserSessionInfo($nick); //Se carga la informacion de la sesion del usuario

            $_SESSION['nick']=$userSessionInfo['nick'];
            $_SESSION['email']=$userSessionInfo['email'];
            $_SESSION['admin']=$userSessionInfo['admin'];
            $_SESSION['check']=hash('ripemd128',$_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
            $_SESSION['start']=time();
            $_SESSION['expire']=$_SESSION['start']+(1*60);

            return true;
        }

        else{ //El usuario y la contraseña no son correctos
            return false;
        }
    }
?>

<!DOCTYPE html>

<html lang="es">
    <?php
        require_once('libreria.php');
        //require_once('session.php');

        $q=new Queries();

        if(empty($q->dbc)){ //No se ha establecido la conexion con la base de datos
            echo "<h3 align='center'> Error: no se pudo establecer la conexión con la base de datos. </h3><br/>";
            die();
        }

        if(isset($_POST['login'])){ //Se ha recibido el valor de login
            if(strnatcasecmp($_POST['submitted'],"Cancelar")==0){
                header('Location: index.php'); //Se vuelve a la pagina principal
            }

            else{
                $check=true;
                $nick=$_POST['nick']; //Se recibe el nombre de usuario
                $password=$_POST['password']; //Se recibe la contraseña

                $checkLogin=login($nick,$password); //Se loguea al usuario

                if($checkLogin){ //Se ha logueado al usuario
                    header('Location: indexlogin.php'); //Se vuelve a la pagina principal
                }

                else{ //No se ha logueado al usuario
                    header('Location: authenticate.php?auth=false'); //Se va a una pagina de error
                }
            }
        }

        if(isset($_GET['auth'])){
            if($_GET['auth']=="false"){
                echo "<h3 align='center' style='color: red'> El nombre de usuario o la contraseña es incorrecto </h3><br>";
            }
        }

        if(isset($_POST['addUser'])){
            if(strnatcasecmp($_POST['submitted'],"Cancelar")==0){
                header('Location: index.php'); //Se vuelve a la pagina principal
            }

            else{
                $check=true;
                $user['nick']=$_POST['nick']; //Se recibe el nombre de usuario
                $user['password']=$_POST['password']; //Se recibe la contraseña
                $user['confirmPassword']=$_POST['confirmPassword']; //Se recibe la confirmacion de la contraseña
                $user['nombre']=$_POST['nombre']; //Se recibe el nombre
                $user['apellidos']=$_POST['apellidos']; //Se recibe el apellido
                $user['sexo']=$_POST['sexo']; //Se recibe el sexo
                $user['email']=$_POST['email']; //Se recibe el email
                $user['telefono']=$_POST['telefono']; //Se recibe el numero de telefono
                $user['beber']=$_POST['beber']; //Se recibe el numero de telefono
                $user['tiza']=$_POST['tiza']; //Se recibe el numero de telefono
                $user['otras']=$_POST['otras']; //Se recibe el numero de telefono
                $user['imagen']=$_POST['imagen']; //Se recibe la imagen del usuario
                $user['admin']=0;

                $check=$q->checkNewUser($user);

                if($check){
                    $status=$q->addUser($user); //Se añade el usuario a la base de datos

                    if($status){ //Se ha añadido al usuario a la base de datos
                        $checkLogin=login($user['nick'],$user['password']); //Se loguea al usuario

                        if($checkLogin){ //Se ha logueado al usuario
                            header('Location: indexlogin.php'); //Se vuelve a la pagina principal
                        }

                        else{ //No se ha logueado al usuario
                            header('Location: authenticate.php?auth=false'); //Se va a una pagina de error
                        }
                    }

                    else{ //No se ha añadido al usuario a la base de datos
                        echo "<h3 align='center' style='color: red'> Ha ocurrido un error. Intentelo de nuevo. </h3><br>";
                    }
                }

                else{
                    echo "<h3 align='center' style='color: red'> Please check the fields and try again. </h3><br>";
                }
            }
        }

echo <<<_END
        <head>
            <title> Login </title>
        </head>
_END;
    ?>

    <body>
        <div class="info">
            <!-- Formulario de logueo del usuario -->
            <form method="post" action="authenticate.php">
                <table align="center" style="margin: 0 auto;">
                    <tr align="center" >
                        <th colspan="2"><h3>Login</h3></th>
                    </tr>  
                    <tr align="left" >
                        <td >Usuario</td>
                        <td ><input type="text" name="nick"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Contraseña</td>
                        <td ><input type="password" name="password"></td>
                    </tr>  
                    <tr align="center" >
                        <td colspan="2">
                            <input type="hidden" name="login" value=true>
                            <input type="submit" name="submitted" value="Aceptar"/>
                            <input type="submit" name="submitted" value="Cancelar"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
                
        <hr width=60% align="center"> 
                
        <div class="info">
            <!-- Formulario de registro del usuario -->
            <form method="post" action="authenticate.php">
                <table align="center" style="margin: 0 auto;">
                    <tr align="center" >
                        <th colspan="2"><h3>Nuevo usuario</h3></th>
                    </tr>  
                    <tr align="left" >
                        <td >Usuario *</td>
                        <td ><input type="text" name="nick"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Contraseña *</td>
                        <td ><input type="password" name="password"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Confirmar contraseña *</td>
                        <td ><input type="password" name="confirmPassword"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Nombre *</td>
                        <td ><input type="text" name="nombre"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Apellidos</td>
                        <td ><input type="text" name="apellidos"></td>
                    </tr>
                    <tr align="left" >
                        <td >Sexo *</td>
                        <td><input type="radio" name="sexo" value="Hombre">Hombre<br>
                        <input type="radio" name="sexo" value="Mujer">Mujer<br>
                        <input type="radio" name="sexo" value="Indefinido" checked>Indefinido<br></td>
                    </tr>
                    <tr align="left" >
                        <td >e-mail *</td>
                        <td ><input type="text" name="email"></td>
                    </tr> 
                    <tr align="left" >
                        <td >Teléfono</td>
                        <td ><input type="text" name="telefono"></td>
                    </tr>
                    <tr align="left" >
                        <td >Hobbies</td>
                        <td>
                            <input type="checkbox" name="beber" value="1">Beber <br>
                            <input type="checkbox" name="tiza" value="1">Chupar tizas <br>
                            <input type="checkbox" name="otras" value="1">Otras <br>
                        </td>
                    </tr>
                    <tr align="left" >
                        <td >Imagen</td>
                        <td ><input type="file" name="imagen"></td>
                    </tr> 
                    <tr align="center" >
                        <td colspan="2">
                            <input type="hidden" name="addUser" value=true>
                            <input type="hidden" name="admin" value=false>
                            <input type="submit" name="submitted" value="Aceptar"/>
                            <input type="submit" name="submitted" value="Cancelar"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>