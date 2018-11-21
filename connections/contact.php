<?php
session_start();
if(@!$_SESSION['nombres']){
 header("Location:https://spinchk.com/index.html");
}


$destino="bienestaruniajc236@gmail.com";
$nombre=$_SESSION['nombres']." ".$_SESSION['apellidos'];
$mensaje=$_POST['mensaje'];
$telefono=$_SESSION['telefono'];
$id=$_SESSION['id'];
$email2=$_SESSION['email'];
$asunto=$_POST['asunto'].$_POST['otroAsunto'];
$contenido="Nombre: ".$nombre."\nID: ".$id."\nCorreo: ".$email2."\nTelefono: ".$telefono."\nMensaje: ".$mensaje;
$cabecera="From: Contacto Bienestar UNIAJC <contactobu@uniajc.com>\r\n";

mail($destino,$asunto,$contenido,$cabecera);

echo '<script language="javascript">alert("Mensaje enviado satisfacoriamente!, Gracias por contactarnos.");</script>';
echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";