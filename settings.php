<?php
session_start();
$usuario = '';
if(!isset($_SESSION['usuario'])){
    header('location: index.php');
}else{
    $usuario = $_SESSION['usuario'];
}
include 'controllers/controllerUser.php';
include 'includes/header.php' ;
switch($usuario['tipo']){
    case 1: include 'includes/menu_user.php';
    break;
    case 2: include 'includes/menu_admin.php';
    break;
}
?>
<div class="container mt-3">
    <h2>Configuración</h2>
</div>
<?php include 'includes/footer.php'?>