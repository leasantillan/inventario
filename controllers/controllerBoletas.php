<?php
require_once 'config/db.php';
$valido=false;
$verform=false;
$periodo=null;
$tipo='';

$formNormal=true;
$formExento=true;
$formWebpay=true;

if(isset($_GET['periodo']) && !isset($_GET['tipo'])){
    $periodo = $_GET['periodo'];
    
    $sql_validar = "SELECT tipo FROM boletas where periodo = '{$periodo}' and user_id = {$usuario['id']}";
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->query($sql_validar);
    if($stmt->rowCount() > 0){
        foreach($stmt as $item){
            if ($item['tipo'] == 'Normal') {
                $formNormal = false;
            }else if ($item['tipo'] == 'Exenta') {
                $formExento = false;
            }
            else if ($item['tipo'] == 'WebPay') {
                $formWebpay = false;
            }
        }
    }
    
    $valido=true;
}

if(isset($_GET['periodo']) && isset($_GET['tipo'])){
    $periodo = $_GET['periodo'];
    $tipo = $_GET['tipo'];
    
    $sql_validar = "SELECT * FROM boletas where periodo = {$periodo} and user_id = {$usuario['id']} and tipo = '{$tipo}'";
    $db = new db();
    $db = $db->connDB();
    $reg = $db->query($sql_validar);
    if($reg->rowCount() == 0){
        $verform = true;
    }
    $valido=true;
}


if(isset($_POST['subir'])){
    $inicial = $_POST['inicial'];
    $final = $_POST['final'];
    $total = $_POST['total'];
    $periodo = $_POST['periodo'];
    $tipo = $_POST['tipo'];
    $sql_register = 'INSERT INTO boletas (inicial,final,total,periodo,tipo,user_id) VALUES (:inicial, :final, :total, :periodo, :tipo, :id)';
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->prepare($sql_register);
    $stmt->bindparam(':inicial', $inicial);
    $stmt->bindparam(':final', $final);
    $stmt->bindparam(':total', $total);
    $stmt->bindparam(':periodo', $periodo);
    $stmt->bindparam(':tipo', $tipo);
    $stmt->bindparam(':id', $usuario['id']);
    if($stmt->execute()){
        $msg['ok'] = 'Registro satisfactorio';
    }
}