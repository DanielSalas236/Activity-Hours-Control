<?php
session_start();
if(@!$_SESSION['nombres']){
 header("Location:https://spinchk.com/index");
}else if($_SESSION['privilegio']=='E1'){
 header("Location:https://spinchk.com/inicio");
}
require("connections/db_connect.php");
    $iduser=$_SESSION["id"];
    $consulta="SELECT * FROM usuario WHERE idusuario='$iduser'";
    $query=mysqli_query($connect,$consulta);
    $f=mysqli_fetch_array($query);

if(isset($_POST['aceptarP'])){
    
    
    if($_POST['telefono']!=''){
      $telefono=$_POST['telefono'];        
    }else{
        $telefono=$f['telefono'];
    }
    if($_POST['direccion']!=''){
      $direccion=$_POST['direccion'];        
    }else{
        $direccion=$f['direccion'];
    }
    if($_FILES['avatar']['name'] == ""){
        $destino=$f['avatar'];
    }else{
    
    $tipo='jpg';
    $type= array('image/jpeg' => 'jpg');
    $nombreImg=$_FILES['avatar']['name'];
    $ruta1=$_FILES['avatar']['tmp_name'];
    $name=$iduser.'.'.$tipo;
    if(is_uploaded_file($ruta1)){
        $destino= "src/useravatar/".$name;
        copy($ruta1,$destino);
    } 
}
    
    
    
    
    $execute=mysqli_query($connect,"UPDATE usuario SET telefono='".$telefono."', direccion='".$direccion."', avatar='".$destino."' WHERE idusuario='".$iduser."'");
    if($execute){
       echo '<script language="javascript">alert("Datos actualizados correctamente");</script>';
        echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
    }else{
        echo '<script language="javascript">alert("Error al guardar");</script>';
    }  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="icon" href="src/favico.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilosdash.css">
    <title>Inicio</title>
</head>

<body>
   
    <div class="container">

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
      <a class="nav-item nav-link active" href="https://spinchk.com/a">Inicio <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="https://spinchk.com/noticiasadm">Noticias</a>
      <a class="nav-item nav-link" href="https://spinchk.com/actividadesadm">Actividades</a>
      <a class="nav-item nav-link" href="https://spinchk.com/gestion">Gestión</a>
      <a class="nav-item nav-link" href="https://spinchk.com/contactoadm">Contacto</a>
    </div>
  </div>
</nav>
        <div class="modal fade" id="ventana1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-tittle">Editar Perfil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form name="reg1" id="reg1" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" aria-label="horas" aria-describedby="basic-addon1" value=""><br>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" aria-label="horas" aria-describedby="basic-addon1" value=""><br>

                            <input type="file" name="avatar"><br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button name="aceptarP" type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="informacion">
            <div class="container">
                <br>
                <div class="row">
                    <div class="perfil">
                        <div class="avatar">
                            <img width="200px" src="<?php echo $f['avatar'] ?>" alt="userimage" class="img-thumbnail rounded-circle">
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="row">

                    <div class="col sm-4">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <?php 
                    echo $_SESSION['nombres'];
                    ?>
                                <?php 
                    echo $_SESSION['apellidos'];
                    ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text">ID Usuario
                                    <?php echo $_SESSION['id']; ?>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="col sm-4">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <div class="row">
                                    <h5>Mis datos personales&nbsp;</h5>
                                    <a href="#ventana1" class="btn btn-warning" data-toggle="modal">Editar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <div class="row">
                                        <p>Nombre completo:
                                            <?php 
                    echo $_SESSION['nombres'];
                    ?>
                                            <?php 
                    echo $_SESSION['apellidos'];
                    ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p>Documento de identidad:
                                            <?php 
                    echo $_SESSION['id'];
                    ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p>Teléfono de contacto:
                                            <?php 
                    echo $f['telefono'];
                    ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p>Fecha de nacimiento:
                                            <?php 
                    echo $_SESSION['fechaN'];
                    ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p>Dirección:
                                            <?php 
                    echo $f['direccion'];
                    ?>
                                        </p>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <br><br>
                </div>
            </div>



        </div>
        
        
        
        
        
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/alerts.js"></script>
</body>
<?php
mysqli_free_result($query);
mysqli_free_result($execute);
mysqli_close($connect);
?>
</html>