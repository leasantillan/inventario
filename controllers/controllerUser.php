<?php
require_once 'config/db.php';

// REGISTRO DE USUARIOS
if(isset($_POST['register'])){
    $r_usuario = isset($_POST['r_usuario']) ? $_POST['r_usuario'] : '';
    $r_pass = isset($_POST['r_pass']) ? $_POST['r_pass'] : '';
    $r_pass2 = isset($_POST['r_pass2']) ? $_POST['r_pass2'] : '';
    $r_nombre = isset($_POST['r_nombre']) ? $_POST['r_nombre'] : '';
    $r_rut = isset($_POST['r_rut']) ? $_POST['r_rut'] : '';
    $r_email = isset($_POST['r_email']) ? $_POST['r_email'] : '';
    $r_tipo = isset($_POST['r_tipo']) ? $_POST['r_tipo'] : 1;
    if(empty($r_usuario) || empty($r_pass) || empty($r_pass2) || empty($r_nombre) || empty($r_rut) || empty($r_email) || empty($r_tipo)){
        $msg['errors'] = 'Campos Vacios';
    }else{
        if($r_pass === $r_pass2){
            $sql_register = 'INSERT INTO usuarios (usuario,pass,nombre,rut,email,tipo) VALUES (:usuario, :pass, :nombre, :rut, :email, :tipo)';
            $db = new db();
            $db = $db->connDB();
            $stmt = $db->prepare($sql_register);
            $stmt->bindparam(':usuario', $r_usuario);
            $stmt->bindparam(':pass', $r_pass);
            $stmt->bindparam(':rut', $r_rut);
            $stmt->bindparam(':nombre', $r_nombre);
            $stmt->bindparam(':email', $r_email);
            $stmt->bindparam(':tipo', $r_tipo);
            if($stmt->execute()){
                $msg['ok'] = 'Registro satisfactorio';
            }
        }else{
            $msg['errors'] = 'Las contraseñas no son iguales';
        }
    }
    $_POST['register']=null;
}   

//ELIMINAR USUARIO
if(isset($_POST['delete'])){
    $id = isset($_POST['d_id']) ? $_POST['d_id'] : '';
    
    $sql_delete="DELETE FROM usuarios WHERE id = {$id}";
    $db = new db();
    $db = $db->connDB();
    $db->query($sql_delete);
}

//MODIFICAR USUARIO
if(isset($_POST['edit'])){
    $e_id = isset($_POST['e_id']) ? $_POST['e_id'] : '';
    $e_nombre = isset($_POST['e_nombre']) ? $_POST['e_nombre'] : '';
    $e_email = isset($_POST['e_email']) ? $_POST['e_email'] : '';
    $e_rut = isset($_POST['e_rut']) ? $_POST['e_rut'] : '';
    $e_tipo = isset($_POST['e_tipo']) ? $_POST['e_tipo'] : '';
    $e_pass = isset($_POST['e_pass']) ? $_POST['e_pass'] : '';
    
    if($usuario['id'] == $e_id){
        $e_tipo = $usuario['tipo'];
    }
    
    $sql_update="UPDATE usuarios SET nombre = :nombre , email = :email ,  rut = :rut , tipo = :tipo, pass = :pass WHERE id = :id";
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->prepare($sql_update);
    $stmt->bindparam(':nombre', $e_nombre);
    $stmt->bindparam(':email', $e_email);
    $stmt->bindparam(':tipo', $e_tipo);
    $stmt->bindparam(':pass', $e_pass);
    $stmt->bindparam(':rut', $e_rut);
    $stmt->bindparam(':id', $e_id);
    $stmt->execute();
    
}




