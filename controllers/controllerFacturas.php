<?php
require_once 'config/db.php';
$verform=false;
$valido=false;

$periodo=null;
$tipo='';
$id_cli=0;
$l_clientes=null;

$formciva=true;
$formexento=true;

    $sql_clientes = "SELECT id, nombre, rut FROM usuarios ";
    $db = new db();
    $db = $db->connDB();
    $l_clientes = $db->query($sql_clientes);
    

if(isset($_GET['periodo']) && isset($_GET['selectCli']) && !isset($_GET['tipo'])){
    $periodo = $_GET['periodo'];
    $id_cli = $_GET['selectCli'];
    
    $sql_validar = "SELECT tipo FROM facturas where periodo = '{$periodo}' and usuario_id = {$id_cli}";
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->query($sql_validar);
    if($stmt->rowCount() > 0){
        foreach($stmt as $item){
            if ($item['tipo'] == 'C/Iva') {
                $formciva = false;
            }else if ($item['tipo'] == 'Exenta') {
                $formexento = false;
            }
        }
    }
    
    $valido=true;
}

if(isset($_GET['periodo']) && isset($_GET['selectCli']) && isset($_GET['tipo'])){
    $periodo = $_GET['periodo'];
    $tipo = $_GET['tipo'];
    $id_cli = $_GET['selectCli'];

    $sql_cliente = "SELECT id, nombre, rut FROM usuarios where id = {$id_cli} ";
    $db = new db();
    $db = $db->connDB();
    $clientes = $db->query($sql_cliente);
    foreach($clientes as $c) {
        $cliente = $c;
    }
    
    $sql_validar = "SELECT * FROM facturas where periodo = {$periodo} and usuario_id = {$id_cli} and tipo = '{$tipo}'";
    $db = new db();
    $db = $db->connDB();
    $reg = $db->query($sql_validar);
    if($reg->rowCount() == 0){
        $verform = true;
    }
    $valido=true;
}


if(isset($_POST['subir'])){
    $total = $_POST['total'];
    $periodo = $_POST['periodo'];
    $tipo = $_POST['tipo'];
    $id_cli = $_POST['selectCli'];
    $sql_register = 'INSERT INTO facturas (total,periodo,tipo,usuario_id) VALUES (:total, :periodo, :tipo, :id)';
    $db = new db();
    $db = $db->connDB();
    $stmt = $db->prepare($sql_register);
    $stmt->bindparam(':total', $total);
    $stmt->bindparam(':periodo', $periodo);
    $stmt->bindparam(':tipo', $tipo);
    $stmt->bindparam(':id', $id_cli);
    if($stmt->execute()){
        $msg['ok'] = 'Registro satisfactorio';
    }
}