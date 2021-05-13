<?php
require 'config/db.php';
session_start();
$usuario = '';
if(!isset($_SESSION['usuario'])){
    header('location: index.php');
}else{
    $usuario = $_SESSION['usuario'];
    $sql_login = 'SELECT * FROM usuarios WHERE id = :id';
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->prepare($sql_login);
    $stmt->bindparam(':id', $usuario['id']);
    $stmt->execute();
    
    if($stmt->rowCount() > 0){
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $usuario = $res;
    }
}
include 'includes/header.php' ;
switch($usuario['tipo']){
    case 1: include 'includes/menu_user.php';
    break;
    case 2: include 'includes/menu_admin.php';
    break;
}
?>
<div class="container mt-3">
    <div class="jumbotron text-center">
        <h1 class="display-4">Hola, <?php echo $usuario['nombre']; ?>!</h1>
        <p class="lead">Panel Dashboard. </p>
    </div>
</div>
<?php include 'includes/footer.php'?>