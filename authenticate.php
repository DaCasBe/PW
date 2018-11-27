<?php
    require_once('libreria.php');

    //Funcion para loguearse en el sistema
    function login($username,$password){
        if(strlen($username)<=0){
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

        $checkUser=$q->checkUserAndPassword($username,$password); //Se comprueba si el usuario y la contraseña son correctos

        if(!$checkUser){ //El usuario o la contraseña no son correctos
            return false;
        }

        else{ //El usuario y la contraseña son correctos
            session_start();

            $userSessionInfo=$q->getUserSessionInfo($username); //Se carga la informacion de la sesion del usuario

            $_SESSION['username']=$userSessionInfo['username'];
            $_SESSION['name']=$userSessionInfo['name'];
            $_SESSION['admin']=$userSessionInfo['admin'];
            $_SESSION['check']=hash('ripemd128',$_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

            header('Location: index.php'); //Se vuelve a la pagina principal

            return true;
        }
    }
?>

<!DOCTYPE html>

<html lang="es">
    <?php
        require_once('libreria.php');

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
                $username=$_POST['username']; //Se recibe el nombre de usuario
                $password=$_POST['password']; //Se recibe la contraseña

                $checkLogin=login($username,$password); //Se loguea al usuario

                if($checkLogin){ //Se ha logueado al usuario
                    header('Location: index.php'); //Se vuelve a la pagina principal
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
                $user['username']=$_POST['username']; //Se recibe el nombre de usuario
                $user['password']=$_POST['password']; //Se recibe la contraseña
                $user['confirmPassword']=$_POST['confirmPassword']; //Se recibe la confirmacion de la contraseña

                if($user['password']!=$user['confirmPassword']){ //La contraseña no es igual a la confirmacion de la contraseña
                    $check=false;
                }

                $user['name']=$_POST['name']; //Se recibe el nombre
                $user['surname']=$_POST['surname']; //Se recibe el apellido
                $user['email']=$_POST['email']; //Se recibe el email
                $user['phone']=$_POST['phone']; //Se recibe el numero de telefono

                if(($_POST['admin']=="Si") || ($_POST['admin']=="Sí")){ //El usuario dice ser administrador
                    $user['admin']=true; //Se establece al usuario como administrador
                }

                else if($_POST['admin']=="No"){ //El usuario dice no ser administrador
                    $user['admin']=0; //Se establece al usuario como no administrador
                }

                else{ //El usuario no ha especificado si es o no administrador
                    $check=false;
                }

                $check=$q->checkNewUser($user);

                if($check){
                    $status=$q->addUser($user); //Se añade el usuario a la base de datos

                    if($status){ //Se ha añadido al usuario a la base de datos
                        $checkLogin=login($user['username'],$user['password']); //Se loguea al usuario

                        if($checkLogin){ //Se ha logueado al usuario
                            header('Location: index.php'); //Se vuelve a la pagina principal
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
                        <td ><input type="text" name="username" value=""></td>
                    </tr>  
                    <tr align="left" >
                        <td >Contraseña</td>
                        <td ><input type="password" name="password" value=""></td>
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
                        <td ><input type="text" name="username"></td>
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
                        <td ><input type="text" name="name"></td>
                    </tr>  
                    <tr align="left" >
                        <td >Apellidos</td>
                        <td ><input type="text" name="surname"></td>
                    </tr>  
                    <tr align="left" >
                        <td >e-mail *</td>
                        <td ><input type="text" name="email"></td>
                    </tr> 
                    <tr align="left" >
                        <td >Teléfono</td>
                        <td ><input type="text" name="phone"></td>
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