<?php
session_start();
if(@!$_SESSION['nombres']){
 header("Location:https://spinchk.com/index");
}else if($_SESSION['privilegio']=='E1'){
 header("Location:https://spinchk.com/inicio");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="icon" href="src/favico.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.css">
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
      <a class="nav-item nav-link" href="https://spinchk.com/admin">Inicio</a>
      <a class="nav-item nav-link" href="https://spinchk.com/noticiasadm">Noticias</a>
      <a class="nav-item nav-link active" href="https://spinchk.com/actividadesadm">Actividades<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="https://spinchk.com/gestion">Gestión</a>
      <a class="nav-item nav-link" href="https://spinchk.com/contactoadm">Contacto</a>
    </div>
  </div>
</nav>
       <?php 
        require("connections/db_connect.php");
        $a=$_SESSION['id'];
        $consulta="SELECT * FROM actividad";
        $control = mysqli_query($connect,$consulta);
        
        if(isset($_POST['aceptarEd'])){
            $idactividad=$_POST['idactividad'];
           $consulta2="SELECT * FROM actividad where idactividad='$idactividad'";
        $control2 = mysqli_query($connect,$consulta2);
            $f3=mysqli_fetch_array($control2);
            $actividad=$_POST['nombreactividad'];
            
            $descripcion=$_POST['descripcion'];
            if($actividad!=''){
                $descripActividad=$actividad;
            }else{
                $descripActividad=$f3['descripcionactividad'];
            }
            if($descripcion!=''){
                $informacion=$descripcion;
            }else{
                $informacion=$f3['informacion'];
            }
            if($_FILES['imagenAc']['name'] == ""){
        $destino=$f3['imagen'];
    }else{
    
    $tipo='jpg';
    $type= array('image/jpeg' => 'jpg');
    $nombreImg=$_FILES['imagenAc']['name'];
    $ruta1=$_FILES['imagenAc']['tmp_name'];
    $name=$idactividad.'.'.$tipo;
    if(is_uploaded_file($ruta1)){
        $destino= "src/imagenActividad/".$name;
        copy($ruta1,$destino);
    } 
}
            $execute=mysqli_query($connect,"UPDATE actividad SET descripcionactividad='".$descripActividad."', informacion='".$informacion."', imagen='".$destino."' WHERE idactividad='".$idactividad."'");
            
            if($execute){
                echo '<script language="javascript">alert("Datos actualizados satisfactoriamente!");</script>';
            }else{
                echo '<script language="javascript">alert("Error al actualizar los datos, por favor comunicate con el soporte en la sección de contacto");</script>';
            }
        }
        
        if(isset($_POST['aceptarAdd'])){
            $idactividad2=$_POST['idactividad2'];
            
            $query3="SELECT * FROM actividad WHERE idactividad='$idactividad2'";
            $execute3=mysqli_query($connect,$query3);
            $rows=mysqli_num_rows($execute3);
            if($rows>0){
                echo '<script language="javascript">alert("Error, la actividad que intenta registrar ya se encuentra en el sistema");</script>';
            }else{
            
            $descripcion2=$_POST['nombreactividad2'];
            $informacion2=$_POST['descripcion2'];
    $tipo='jpg';
    $type= array('image/jpeg' => 'jpg');
    $nombreImg=$_FILES['imagenAc2']['name'];
    $ruta1=$_FILES['imagenAc2']['tmp_name'];
    $name=$idactividad2.'.'.$tipo;
    if(is_uploaded_file($ruta1)){
        $destino2= "src/imagenActividad/".$name;
        copy($ruta1,$destino2);
    } 
           
            $query2="INSERT INTO actividad VALUES('$idactividad2','$descripcion2','$informacion2','$destino2')";
           $execute2=mysqli_query($connect,$query2);
            if($execute2){
                echo '<script language="javascript">alert("Actividad creada satisfactoriamente!");</script>';
                echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
            }else{
                echo '<script language="javascript">alert("Error al crear la actividad, por favor comunicate con el soporte en la sección de contacto");</script>';
            }
        }
        }
        
        ?>
        <div class="informacion">
           <header><img src="src/imagenActividad/bu.jpg" class="img-fluid" alt="Responsive image"></header><br>
<br>
          <div class="container">
           <div class="row"><div class="col"><a href="#ventanaAdd" class="btn btn-primary btn-lg" data-toggle="modal">Añadir Actividad</a></div></div></div>
               <div class="gestion">
           <div class="modal fade" id="ventanaAdd">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-tittle">Añadir una actividad</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form name="reg1" id="reg1" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                   <input type="text" name="idactividad2" value="" placeholder="ID de la actividad" required><br>
                                    <input type="text" name="nombreactividad2" class="form-control" placeholder="Nombre de la actividad" aria-describedby="basic-addon1" required><br>
                                    <input type="text" name="descripcion2" class="form-control" placeholder="Descripción de la actividad" aria-label="horas" aria-describedby="basic-addon1"><br>
                                    <input type="file" name="imagenAc2" required><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button name="aceptarAdd" type="submit" class="btn btn-primary">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
<br>
            <div class="row">
            
    <?php 
        while($f2 = mysqli_fetch_array($control)){
        ?>
            <div class="col">
                    
        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $f2['imagen'] ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $f2['descripcionactividad'] ?></h5>
    <p class="card-text"><?php echo $f2['informacion'] ?></p>
    <a href="#ventana<?php echo $f2["idactividad"] ?>" class="btn btn-primary btn-lg" data-toggle="modal">Editar</a>
    
  </div>
</div>     
              <div class="gestion">
           <div class="modal fade" id="ventana<?php echo $f2["idactividad"] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-tittle">Editar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form name="reg1" id="reg1" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                   <input type="hidden" name="idactividad" value="<?php echo $f2['idactividad'] ?>"><br>
                                    <input type="text" name="nombreactividad" class="form-control" placeholder="Nombre de la actividad" aria-label="horas" aria-describedby="basic-addon1"><br>
                                    <input type="text" name="descripcion" class="form-control" placeholder="Descripción de la actividad" aria-label="horas" aria-describedby="basic-addon1"><br>
                                    <input type="file" name="imagenAc"><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button name="aceptarEd" type="submit" class="btn btn-primary">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
           </div>

            <?php   
        }

     ?>
           
            </div>
           
        </div>
        
        
        
        
        
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/alerts.js"></script>
</body>
<?php
mysqli_free_result($control);
mysqli_free_result($control2);
mysqli_free_result($execute);
mysqli_free_result($execute2);
mysqli_free_result($execute3);
mysqli_close($connect);
?>
</html>