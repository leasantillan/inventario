
<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard - SystemPHP</title>
</head>
<body>
    <div id="header" class="container my-3 row mx-auto">
        <div class="col-2 ">
            <a href="dashboard.php"><img src="./assets/img/logo.png" class="img-fluid my-2 "   alt="System PHP"></a>
            <div class="ml-2" style="font-size:14px; font-style:italic;color:#777;"> <strong>Usuario: </strong> <?php echo $usuario['nombre'] ?></div>
        </div>
        <div class="col-10 ">
            <div class="float-right d-block mt-4">				
                <?php if($usuario['tipo'] == 1){
                    ?>
                    <a href="settings.php" title="Configuracion">Configuración</a><span class="mx-3 d-none d-sm-inline">|</span>
                    <a href="logout.php" title="Salir">Salir</a>
                    <?php
                } ?>
                <?php if($usuario['tipo'] == 2){
                    ?>
                    <a href="users.php" title="Usuarios" >Usuarios</a><span class="mx-3 d-none d-sm-inline">|</span>
                    <a href="settings.php" title="Configuracion">Configuración</a><span class="mx-3 d-none d-sm-inline">|</span>
                    <a href="logout.php" title="Salir">Salir</a>
                    <?php
                } ?>
            </div>
        </div>
    </div>