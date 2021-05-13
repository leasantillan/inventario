<?php
error_reporting(E_ALL); 
ini_set('display_errors', '1');

require_once 'config/db.php';

if(isset($_POST['signin'])){
    session_start();
    $usuario = isset($_POST['u_usuario']) ? $_POST['u_usuario'] : '';
    $pass = isset($_POST['u_pass']) ? $_POST['u_pass'] : '';
    
    if(empty($usuario) || empty($pass)){
        $_SESSION['errors'] = 'Campos Vacios';
        header('location: index.php',true);
    }
    
    $sql_login = 'SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :pass';
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->prepare($sql_login);
    $stmt->bindparam(':usuario', $usuario);
    $stmt->bindparam(':pass', $pass);
    $stmt->execute();
    
    if($stmt->rowCount() > 0){
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['usuario'] = $res;
        header('location: dashboard.php',true);
    }else{
        unset($_POST['signin']);
        $_SESSION['errors'] = 'Error de Autenticacion ';
        header('location: index.php',true);
        
    }    
}
else{
    header('location: index.php',true);
}