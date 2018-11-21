<?php
session_start();
if(@!$_SESSION['nombres']){
 header("Location:https://spinchk.com/index");
}else if($_SESSION['privilegio']=='A1'){
 header("Location:https://spinchk.com/admin");
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
      <a class="nav-item nav-link" href="https://spinchk.com/inicio">Inicio</a>
      <a class="nav-item nav-link" href="https://spinchk.com/noticias">Noticias</a>
      <a class="nav-item nav-link active" href="https://spinchk.com/registroactividad">Actividades<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="https://spinchk.com/control">Control</a>
      <a class="nav-item nav-link" href="https://spinchk.com/contacto">Contacto</a>
    </div>
  </div>
</nav>
       <?php 
        require("connections/db_connect.php");
        $a=$_SESSION['id'];
        $consulta="SELECT * FROM actividad";
        $control = mysqli_query($connect,$consulta);
        
        date_default_timezone_set('America/Bogota');
        $fecha=date("Y-m-d");
        $fechaComp= strtotime($fecha);
        $fechaComp2 = strtotime("2018-06-30");
        if($fechaComp<$fechaComp2){
            $periodo='2018-01';
        }else{
            $periodo='2018-02';
        }
        
        if(isset($_POST['registrarme'])){
            $actividad=$_POST['idactividad'];
            $execute2=mysqli_query($connect,"SELECT * FROM usuario_actividad WHERE usuario_idusuario='$a'");
            $rows=mysqli_num_rows($execute2);
            if($rows==0){
                $execute3=mysqli_query($connect,"INSERT INTO usuario_actividad VALUES('$actividad','$a','$periodo','$fecha')");
                if($execute3){
                echo '<script language="javascript">alert("Registrado satisfactoriamente!");</script>';
            }else{
                echo '<script language="javascript">alert("Error al registrar, por favor comunicate con el soporte en la sección de contacto");</script>';
            }
            }else{
            $query="UPDATE usuario_actividad SET codactividad=$actividad, periodo='$periodo', fecha='$fecha' WHERE usuario_idusuario=$a";
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo '<script language="javascript">alert("Registrado satisfactoriamente!");</script>';
            }else{
                echo '<script language="javascript">alert("Error al registrar, por favor comunicate con el soporte en la sección de contacto");</script>';
            }
          }    
        }
        
        ?>
        <div class="informacion">
           <header><img src="src/imagenActividad/bu.jpg" class="img-fluid" alt="Responsive image"></header><br><br>
            <div class="row">
            
    <?php 
        while($f2 = mysqli_fetch_array($control)){
        ?>
            <div class="col">
             <form method="post">       
        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $f2['imagen'] ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $f2['descripcionactividad'] ?></h5>
    <p class="card-text"><?php echo $f2['informacion'] ?></p>
    <button name="registrarme" type="submit" class="btn btn-primary">Inscribirme</button>
    <input type="hidden" name="idactividad" value="<?php echo $f2['idactividad'] ?>">
  </div>
</div>        
           </form>
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
mysqli_free_result($execute);
mysqli_free_result($execute2);
mysqli_free_result($execute3);
mysqli_close($connect);
?>
</html>