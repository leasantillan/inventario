<?php 
session_start();

$usuario = '';
if(!isset($_SESSION['usuario'])){
    header('location: index.php');
}else{
    $usuario = $_SESSION['usuario'];
}
if($usuario['tipo'] != 2){
    header('location: dashboard.php');
}
include 'controllers/controllerUser.php';
include 'includes/header.php' ;
include 'includes/menu_admin.php';

?>
<div class="container mt-3">
    <h2>Registro de Usuario</h2>
    <hr class="my-3">
    <div class="row mx-0 my-4">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="register.php" method="POST" class="form-signin">
                <label for="inputUsuario" class="sr-only">Usuario</label>
                <input name="r_usuario" type="text" id="inputUsuario" class="form-control" placeholder="Usuario" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="r_pass" type="text" id="inputPassword" class="form-control" placeholder="Password" required="">
                <label for="inputPassword2" class="sr-only">Repetir Password</label>
                <input name="r_pass2" type="text" id="inputPassword2" class="form-control" placeholder="Repetir Password" required="">
                <hr class="my-3">
                <label for="inputNombre" class="sr-only">Nombre</label>
                <input name="r_nombre" type="text" id="inputNombre" class="form-control" placeholder="Nombre" required="">
                <label for="inputRut" class="sr-only">RUT</label>
                <input name="r_rut" type="text" id="inputRut" class="form-control" placeholder="RUT" required="">
                <label for="inputEmail" class="sr-only">Usuario</label>
                <input name="r_email" type="email" id="inputEmail" class="form-control" placeholder="Email" required="">
                <hr class="my-3">
                <select name="r_tipo" class="form-control mb-3" id="tipoUsuario">
                    <option value="1">Usuario</option>
                    <option value="2">Administrador</option>
                </select>
                
                <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Registrar</button>
                <hr>
                <?php if(isset($msg['errors'])){?>
                    <span class="alert alert-danger" role="alert"> <?php  echo $msg['errors']; ?></span>
                    <?php $msg['errors'] = null;
                } ?>
                <?php if(isset($msg['ok'])){?>
                    <span class="alert alert-success" role="alert"> <?php  echo $msg['ok']; ?></span>
                    <?php $msg['ok'] = null;
                } ?>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>