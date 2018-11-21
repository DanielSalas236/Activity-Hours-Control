<?php
session_start();
if(@!$_SESSION['nombres']){
 header("Location:https://spinchk.com/index");
}else if($_SESSION['privilegio']=='E1'){
 header("Location:https://spinchk.com/inicio");
}


require("connections/db_connect.php");

$actividad=$_POST['actividad'];
$idusuario=$_POST['idusuario'];
$periodo=$_POST['periodo'];
$and="";
$mensaje="";
if(isset($_POST['buscar'])){
    
    if($periodo!=''){
        $AND="AND ua.periodo='$periodo'";
    }else{
        $AND='';
    }if($actividad!=''){
        $AND2="AND a.idactividad='$actividad'";
    }else{
        $AND2='';
    }if($idusuario!=''){
        $AND3=$and="AND ua.usuario_idusuario='$idusuario'";
    }else{
        $AND3='';
    }if($periodo!=''&&$actividad!=''&&$idusuario!=''){
        $AND4="AND ua.periodo='$periodo' AND a.idactividad='$actividad' AND ua.usuario_idusuario='$idusuario'";
    }

}else if(isset($_POST['refresh'])){
    $and="";
    $mensaje="";
//    echo '<script type="text/javascript">';
//  echo 'setTimeout(function () { swal("WOW!","Message!","success");';
//  echo '}, 10);</script>';
}

        $a=$_SESSION['id'];
        $consulta="SELECT ua.usuario_idusuario id, ua.periodo, u.nombres nombre, u.apellidos, u.avatar, a.descripcionactividad actividad FROM usuario u, actividad a, usuario_actividad ua WHERE a.idactividad=ua.codactividad and ua.usuario_idusuario=u.idusuario $AND $AND2 $AND3 $AND4 ORDER BY u.idusuario ASC";
        $control = mysqli_query($connect,$consulta);
        $rows = mysqli_num_rows($control);
if($rows==0){
    $mensaje="<div class='alert alert-danger' role='alert'>
  No se obtuvieron datos con los criterios de búsqueda ingredados.
</div>";
}else{
    $mensaje='';
}


if(isset($_POST['aceptarR'])){
$iduser=$_POST['id'];
    $actividadR=$_POST['actividadR'];
$consulta2="SELECT MAX(consecutivo) consec FROM control WHERE idusuario='$iduser' AND codactividad='$actividadR'";
$control2 = mysqli_query($connect,$consulta2);
$f4 = mysqli_fetch_array($control2);
$cantF = mysqli_num_rows($control2);
    if($cantF>0){
       $consecutivo=1+$f4['consec']; 
    }else{
       $consecutivo=0;
    }
$fechaR=$_POST['fechaR'];

$horasR=$_POST['horasR'];
    
    $insert="INSERT INTO control VALUES('$iduser','$actividadR','$consecutivo','$fechaR','$horasR','$a')";
    mysqli_query($connect,$insert);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="icon" href="src/favico.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <title>Inicio</title>
</head>

<body>

    <div class="container">
        <div class="gestion">
            <div class="logout">
                <form action="connections/logout.php">
                    <button type="submit" class="btn btn-light">cerrar sesión</button>
                </form>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="https://spinchk.com/admin">Inicio</a>
                        <a class="nav-item nav-link" href="https://spinchk.com/noticiasadm">Noticias</a>
                        <a class="nav-item nav-link" href="https://spinchk.com/actividadesadm">Actividades</a>
                        <a class="nav-item nav-link active" href="https://spinchk.com/gestion">Gestión<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="https://spinchk.com/contactoadm">Contacto</a>
                    </div>
                </div>
            </nav>
            <div class="informacion">
                <div class="container">


                    <form method="post">
                        <h6><br>Filtros:</h6>
                        <div class="row">
                            <div class="col sm-4">
                                <input type="text" name="idusuario" class="form-control" placeholder="ID Usuario" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="col sm-4">
                                <select name="actividad" id="actividad">
                                    <option value="">-Actividad-</option>
                                    <option value="5220">Tenis De Mesa</option>
                                    <option value="5221">Voleibol</option>
                                    <option value="5222">Baile Urbano</option>
                                    <option value="5223">Natacion</option>
                                    <option value="5224">Rugby</option>
                                    <option value="5225">Futbol</option>
                                    <option value="5226">Guitarra</option>
                                    <option value="5227">Pintura</option>
                                    <option value="5228">Baloncesto</option>
                                    <option value="5229">Kung Fu</option>
                                </select>
                            </div>
                            
                            <div class="col sm-2">
                                <select name="periodo" id="periodo">
                                    <option value="">-Periodo-</option>
                                    <option value="2018-02">2018-02</option>
                                    <option value="2018-01">2018-01</option>
                                </select>
                            </div>

                            
                            <div class="col sm-2">
                                <button name="buscar" id="registrar" type="submit" class="btn btn-primary">Buscar</button>
                                <button name="refresh" id="registrar" type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                    </form><br>
                    <form name="registrar">
                        <table class="table table-hover">

                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Actividad</th>
                                <th scope="col">Periodo</th>
                                <th scope="col">Registro</th>
                                <th scope="col"></th>
                            </tr>
                            <?php 
        while($f2 = mysqli_fetch_array($control)){
        ?>
                            <tr>
                                <td>
                                    <?php echo $f2["id"]?>
                                </td>
                                <td>
                                    <?php echo $f2["nombre"]." ".$f2['apellidos']?>
                                </td>
                                <td>
                                    <?php echo $f2["actividad"]?>
                                </td>
                                <td>
                                    <?php echo $f2["periodo"]?>
                                </td>
                                <td>
                                    <a href="#ventana<?php echo $f2["id"] ?>" class="btn btn-primary btn-lg" data-toggle="modal">Registro</a>
                                </td>
                                <td>
                                    <img width="75px" height="70px" src="<?php echo $f2["avatar"]?>" alt="">
                                </td>


                                <div class="modal fade" id="ventana<?php echo $f2["id"] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-tittle">Crear Registro</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <form name="reg1" id="reg1" method="post">
                                                <div class="modal-body">
                                                    <input type="text" name="id" id="id" class="form-control" placeholder="ID" aria-label="horas" aria-describedby="basic-addon1" value="<?php echo $f2["id"] ?>" required><br>
                                                    <div class="fechanacimiento">
                                                        <label for="date">Fecha de asistencia</label>
                                                        <input type="date" id="start" name="fechaR" value="" min="1900-01-01" max="2018-12-31" required />
                                                    </div><br>
                                                    <select name="actividadR" id="actividad" required>
                                                        <option value="">-Actividad-</option>
                                                        <option value="5220">Tenis De Mesa</option>
                                                        <option value="5221">Voleibol</option>
                                                        <option value="5222">Baile Urbano</option>
                                                        <option value="5223">Natacion</option>
                                                        <option value="5224">Rugby</option>
                                                        <option value="5225">Futbol</option>
                                                        <option value="5226">Guitarra</option>
                                                        <option value="5227">Pintura</option>
                                                        <option value="5228">Baloncesto</option>
                                                        <option value="5229">Kung Fu</option>
                                                    </select><br>
                                                    <input type="number" name="horasR" class="form-control" placeholder="Horas" aria-label="horas" aria-describedby="basic-addon1" required><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button name="aceptarR" type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </tr>
                            <?php   
        }

     ?>
                        </table>
                        <?php echo $mensaje; ?><br>
                    </form>
                </div>
            </div>



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/alerts.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="https://cdn.jsdelivr.net/es6-promise/latest/es6-promise.auto.min.js"></script>
</body>
<?php
mysqli_free_result($control);
mysqli_free_result($control2);
mysqli_close($connect);
?>

</html>
