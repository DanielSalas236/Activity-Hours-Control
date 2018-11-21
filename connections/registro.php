<?php
    $cabecera = "From: Bienestar Universitario Uniajc <bienestaruniajc@spinchk.com>\r\n";
	$nuser=$_POST['nuser'];
	$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$email=$_POST['email'];
$nacimiento=$_POST['nacimiento'];
$tel=$_POST['tel'];
$typeId=$_POST['typeId'];
$sexo=$_POST['sexo'];
$direccion=$_POST['direccion'];
$programa=$_POST['programa'];
	require("db_connect.php");
//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$checknuser=mysqli_query($connect,"SELECT * FROM usuario WHERE idusuario='$nuser'");
    $checkemail=mysqli_query($connect,"SELECT * FROM usuario WHERE email='$email'");
$check_nuser=mysqli_num_rows($checknuser);
	$check_email=mysqli_num_rows($checkemail);

                if($check_nuser>0){
				echo ' <script language="javascript">alert("Atencion, el usuario ya se encuentra registrado, por favor verifique sus datos");</script> ';
                echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
			}else if($check_email>0){
                echo ' <script language="javascript">alert("Atencion, ya existe un usuario con el correo ingresado, por favor verifique sus datos");</script> ';
                echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
            }else{
                include('class.generarpass.php');
                $passn = new GenerarPass();
                $newpass = $passn->NewPass(5);
				mysqli_query($connect,"insert into usuario values ('$nuser','$typeId','$apellidos','$nombres','$nacimiento','$sexo','$email','$direccion','$tel','$newpass','E1','$programa','src/useravatar/userimage.jpg');");
                mail($email, 'Datos de acceso BU Uniajc',"Hola, tus datos de acceso son: \nUsuario: $nuser \nClave: $newpass",$cabecera);
				echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
				echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
			}

mysqli_free_result($cheknuser);
mysqli_close($check_nuser);
mysqli_close($connect);
?>
