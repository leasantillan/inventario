<?php 
// error_reporting(E_ALL); 
// ini_set('display_errors', '1');
session_start();

if(isset($_SESSION['usuario'])){
  header('location: dashboard.php',true);
}
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/signin.css">

    <title>Iniciar Sesion - SystemPHP</title>
</head>
<body class="text-center">
    <form action="login.php" method="POST" class="form-signin">
        <img class="mb-4" src="./assets/img/logo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
        <label for="inputUsuario" class="sr-only">Usuario</label>
        <input name="u_usuario" type="text" id="inputUsuario" class="form-control" placeholder="Usuario" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="u_pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">

        <button class="btn btn-lg btn-primary btn-block" name="signin" type="submit">Ingresar</button>
        <hr>
        <?php if(isset($_SESSION['errors'])){?>
        <span class="alert alert-danger" role="alert"> <?php  echo $_SESSION['errors']; ?></span>
        <?php $_SESSION['errors'] = null;
        } ?>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>