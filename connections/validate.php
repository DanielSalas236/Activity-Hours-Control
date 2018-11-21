<?php
session_start();
require("db_connect.php");
$consulta="SELECT * FROM usuario WHERE idusuario='$user' and clave='$pass'";
$resultado = mysqli_query($connect,$consulta);
$filas = mysqli_num_rows($resultado);
$f2 = mysqli_fetch_array($resultado);
 $_SESSION['privilegio']=$f2['tipousuario_idtipo'];


if ($f2['tipousuario_idtipo']=='E1'){
    $a = $f2['idusuario'];
    $consultHoras="select SUM(horas) as horasT from control where idusuario='$a'";
    $horas = mysqli_query($connect,$consultHoras);
    $filas2 = mysqli_num_rows($horas);
    $f3 = mysqli_fetch_array($horas);
    

    $_SESSION['nombres']= $f2['nombres'];
    $_SESSION['apellidos']= $f2['apellidos'];
    $_SESSION['clave']= $f2['clave'];
    $_SESSION['id']= $f2['idusuario'];
    $_SESSION['fechaN']= $f2['fechanacimiento'];
    $_SESSION['horas']= $f3['horasT'];
    $_SESSION['email']= $f2['email'];
    $_SESSION['telefono']= $f2['telefono'];
    header ("location: https://spinchk.com/inicio");
}
    else if($f2['tipousuario_idtipo']=='A1'){
    $_SESSION['nombres']= $f2['nombres'];
    $_SESSION['apellidos']= $f2['apellidos'];
    $_SESSION['clave']= $f2['clave'];
    $_SESSION['id']= $f2['idusuario'];
    $_SESSION['fechaN']= $f2['fechanacimiento'];
    $_SESSION['telefono']= $f2['telefono'];
    header ("location: https://spinchk.com/admin"); 
    }
    else{    
    echo '<script language="javascript">alert("Error de autenticación");</script>'; 
    echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
}

mysqli_free_result($resultado);
mysqli_free_result($horas);
mysqli_close($connect);