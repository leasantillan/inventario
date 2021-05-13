<?php
ini_set('display_errors',1);
error_reporting(1);
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
if($usuario['tipo'] != 2){
    header('location: dashboard.php');
}
include ('controllers/controllerFacturas.php');
include 'includes/header.php' ;
switch($usuario['tipo']){
    case 1: include 'includes/menu_user.php';
    break;
    case 2: include 'includes/menu_admin.php';
    break;
}
?>
<div class="container mt-3">
    <h2>Facturas</h2>
    <hr class="my-3">
    <?php if(!$valido){?>
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <form action="facturas.php" method="GET" class="form-inline my-4">
                    <div class="form-group mb-2 mx-auto">
                        <label for="selectCli" class="sr-only">Cliente</label>
                        <select name="selectCli" id="selectCli"  class="form-control mr-3">
                            <?php foreach($l_clientes as $c){ ?>
                            <option value="<?php echo $c['id']?>"><?php echo $c['nombre']?> - <?php echo $c['rut']?></option><?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-2 mx-auto">
                        <label for="inputMes" class="sr-only">Periodo</label>
                        <input type="month" name="periodo" id="inputMes" value="<?php echo date('Y-m') ?>" max="<?php echo date('Y-m') ?>" class="form-control mr-3">
                        <button type="submit" class="btn btn-light">Validar</button>
                    </div>
                    
                </form>
            </div>
        </div>
        
    <?php } ?>
        <?php if($valido && !$verform){?>
            <div class="row text-center boletas-icons">
                <div class="col-sm-6">
                    <?php if($formciva){echo '<a href="facturas.php?tipo=C/Iva&selectCli='.$id_cli.'&periodo='.$periodo.'">';} ?>
                    <div class="icon rounded-circle bg-dark mb-3">
                        <span class="display-3"><i class="fas fa-file-invoice-dollar"></i></span>
                    </div>
                    <strong>Boleta C/Iva</strong>
                    <?php if($formciva){echo '</a>';} ?> 
                </div>
                <div class="col-sm-6">
                    <?php if($formexento){echo '<a href="facturas.php?tipo=Exenta&selectCli='.$id_cli.'&periodo='.$periodo.'">';} ?>
                    <div class="icon rounded-circle bg-dark mb-3">
                        <span class="display-3"><i class="fas fa-file-invoice"></i></span>
                    </div>
                    <strong>Boleta Exenta</strong>
                    <?php if($formexento){echo '</a>';} ?> 
                </div>
            </div>
            
            <?php } ?>
            <?php if($verform && $valido){ ?>
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        
                        <form action="facturas.php" method="POST">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Periodo: </strong><br>
                                    <input type="month" name="periodo"  id="inputMes" value="<?php echo $periodo ?>" readonly class="d-inline form-control-plaintext">
                                </div>
                                <div class="col-sm-6">
                                    <strong>Cliente: </strong> <br>
                                    <select  name="selectCli" id="selectCli" readonly class="d-inline form-control">
                                    <option value="<?php echo $id_cli ?>" selected><?php echo $cliente['nombre'] ?> - <?php echo $cliente['rut'] ?></option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <strong>Boleta:</strong><br>
                                     <input type="text" name="tipo" readonly class="d-inline form-control-plaintext" value="<?php echo $tipo ?>">
                             </div>
                            </div>
                            
                            
                            <div class="form-group mt-3">
                                <label for="inputTotal" class="sr-only">Ventas Totales</label>
                                <input type="number" name="total" id="inputTotal" class="form-control mr-3" placeholder="Ventas Totales" required>
                            </div>
                            <button type="submit" class="btn btn-light" name="subir">Subir</button>
                        </form>
                    </div>
                </div>
                
                <?php } ?>
                <hr>
                <?php if(isset($msg['errors'])){?>
                    <span class="alert alert-danger" role="alert"> <?php  echo $msg['errors']; ?></span>
                    <?php $msg['errors'] = null;
                } ?>
                <?php if(isset($msg['ok'])){?>
                    <span class="alert alert-success" role="alert"> <?php  echo $msg['ok']; ?></span>
                    <?php $msg['ok'] = null;
                } ?>
            </div>
            <?php include 'includes/footer.php'?>