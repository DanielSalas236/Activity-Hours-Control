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
                    <a class="nav-item nav-link" href="https://spinchk.com/admin">Inicio</a>
                    <a class="nav-item nav-link" href="https://spinchk.com/noticiasadm">Noticias</a>
                    <a class="nav-item nav-link" href="https://spinchk.com/actividadesadm">Actividades</a>
                    <a class="nav-item nav-link" href="https://spinchk.com/gestion">Gestión</a>
                    <a class="nav-item nav-link active" href="https://spinchk.com/contactoadm">Contacto<span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>


        <div class="informacion">
           <header><img src="src/contacto.jpg" class="img-fluid" alt="Responsive image"></header><br>
            <div class="container"><br>
                
                <div class="gestion">
                    
                    <form action="connections/contact.php" method="post">
                        
                        <select name="asunto" id="" onchange="carg(this);" required>
                            <option value="">--Asunto---</option>
                            <option value="Reporte de Error">Reporte de Error</option>
                            <option value="Reclamo">Reclamo</option>
                            <option value="Sugerencia">Sugerencia</option>
                            <option value="Solicitud">Solicitud</option>
                            <option value="(Otro/s) ">Otro</option>
                        </select><br>
                        <input type="hidden" placeholder="" name="otroAsunto" id="otroAsunto" disabled><br>
                        <textarea name="mensaje" id="mensaje" class="form-control" aria-label="With textarea" placeholder="Mensaje... Por favor seleccione un asunto" required disabled></textarea><br>
                        <button class="btn btn-primary">Enviar</button>
                    </form><br>
                    <p>Nota: Tus datos de contacto son enviados automáticamente por el sistema, así que no es necesario que los ingreses.</p><br>
                </div>
                
            </div>



        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/alerts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="https://cdn.jsdelivr.net/es6-promise/latest/es6-promise.auto.min.js"></script>
    <script src="js/tema.js"></script>
</body>

</html>
