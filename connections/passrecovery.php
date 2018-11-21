<?php
$cabecera = "From: Bienestar Universitario Uniajc <bienestaruniajc@spinchk.com>\r\n";
$nuser=$_POST['nuser'];
//$typeId=$_POST['typeId'];
$email=$_POST['email'];
	require("db_connect.php");
//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$checknuser=mysqli_query($connect,"SELECT idusuario FROM usuario WHERE idusuario='$nuser'");
    $checkemail=mysqli_query($connect,"SELECT email FROM usuario WHERE email='$email'");
$check_nuser=mysqli_num_rows($checknuser);
	$check_email=mysqli_fetch_array($checkemail);
		$emailBd=$check_email['email'];

			if($check_nuser==0){
				echo ' <script language="javascript">alert("Atencion, No se encontró el usuario ingresado");</script> ';
                echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
			}
else if($email!=$emailBd){
                echo ' <script language="javascript">alert("El correo no coincide con el del usuario ingresado");</script> ';
    echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
            }
             else{
				$consult=mysqli_query($connect,"SELECT clave FROM usuario WHERE idusuario='$nuser';");
                $row = mysqli_fetch_array($consult);
   //Guardo los datos de la BD en las variables de php
                $clave=$row['clave'];
                mail($email, 'Recuperación de contraseña',"Hola, tus datos de acceso son: \nUsuario: $nuser \nClave: $clave",$cabecera);
				echo ' <script language="javascript">alert("Revisa tu correo eléctronico");</script> ';
				echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
			}
mysqli_free_result($cheknuser);
mysqli_close($check_nuser);
mysqli_close($connect);
?>