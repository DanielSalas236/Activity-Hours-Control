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
      <a class="nav-item nav-link" href="https://spinchk.com/registroactividad">Actividades</a>
      <a class="nav-item nav-link active" href="https://spinchk.com/control.php">Control<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="https://spinchk.com/contacto">Contacto</a>
    </div>
  </div>
</nav>
       <?php 
        require("connections/db_connect.php");
        $a=$_SESSION['id'];
        $consulta="SELECT c.fecha fecha, a.descripcionactividad actividad, c.horas horas, u.nombres validado, u.apellidos FROM control c, usuario u, actividad a WHERE u.idusuario = c.idusuario2 and a.idactividad=c.codactividad AND c.idusuario='$a' ORDER BY c.fecha DESC";
        $control = mysqli_query($connect,$consulta);
        $rows=mysqli_num_rows($control);
        if($rows==0){
            $mensaje="<div class='alert alert-primary' role='alert'>
  Aún no tienes registro de asistencia a actividades!
</div>";
        }
        ?>
        <div class="informacion">
            <div class="container"><br>
            <table class="table table-hover">

    <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Actividad</th>
        <th scope="col">Horas</th>
        <th scope="col">Validado por</th>
    </tr>
    <?php 
        while($f2 = mysqli_fetch_array($control)){
        ?>
            <tr>
                <td><?php echo $f2["fecha"]?></td>
                <td><?php echo $f2["actividad"]?></td>
                <td><?php echo $f2["horas"]?></td>
                <td><?php echo $f2["validado"]." ".$f2["apellidos"]?></td>
            </tr>
            <?php   
        }

     ?>
    </table>
           <?php echo $mensaje; ?><br>
            
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
mysqli_close($connect);
?>
</html>