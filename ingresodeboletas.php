<?php
session_start();
$usuario = '';
if(!isset($_SESSION['usuario'])){
    header('location: index.php');
}else{
    $usuario = $_SESSION['usuario'];
}
include ('controllers/controllerBoletas.php');
include 'includes/header.php' ;
switch($usuario['tipo']){
    case 1: include 'includes/menu_user.php';
    break;
    case 2: include 'includes/menu_admin.php';
    break;
}
?>
<div class="container mt-3">
    <h2>Ingreso de boletas</h2>
    <hr class="my-3">
    <?php if(!$valido){?>
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <form action="ingresodeboletas.php" method="GET" class="form-inline my-4">
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
                <div class="col-sm-4">
                    <div class="icon rounded-circle bg-dark mb-3">
                        <?php if($formNormal){echo '<a href="ingresodeboletas.php?tipo=Normal&periodo='.$periodo.'">';} ?>
                            <span class="display-3"><i class="fas fa-file-invoice-dollar"></i></span>
                        <?php if($formNormal){echo '</a>';} ?>
                    </div>
                    <?php if($formNormal){echo '<a href="ingresodeboletas.php?tipo=Normal&periodo='.$periodo.'">';} ?>
                        <strong>Boleta Normal</strong>
                    <?php if($formNormal){echo '</a>';} ?>
                </div>
                <div class="col-sm-4">
                    <div class="icon rounded-circle bg-dark mb-3">
                        <?php if($formExento){echo '<a href="ingresodeboletas.php?tipo=Exenta&periodo='.$periodo.'">';} ?>
                            <span class="display-3"><i class="fas fa-file-invoice"></i></span>
                        <?php if($formExento){echo '</a>';} ?>
                    </div>
                    <?php if($formExento){echo '<a href="ingresodeboletas.php?tipo=Exenta&periodo='.$periodo.'">';} ?>
                        <strong>Boleta Exenta</strong>
                    <?php if($formExento){echo '</a>';} ?>
                </div>
                <div class="col-sm-4">
                    <div class="icon rounded-circle bg-dark mb-3">
                    <?php if($formWebpay){echo '<a href="ingresodeboletas.php?tipo=WebPay&periodo='.$periodo.'">';} ?>
                        <span class="display-3"><i class="fas fa-file-alt"></i></span>
                        <?php if($formWebpay){echo '</a>';} ?>
                    </div>
                    <?php if($formWebpay){echo '<a href="ingresodeboletas.php?tipo=WebPay&periodo='.$periodo.'">';} ?>
                    <strong>Boleta WebPay</strong>
                    <?php if($formWebpay){echo '</a>';} ?>
                </div>
            </div>
            
            <?php } ?>
            <?php if($verform && $valido){ ?>
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        
                        <form action="ingresodeboletas.php" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <strong>Boleta:</strong> <input type="text" name="tipo" style="width:70%!important;" readonly class="d-inline form-control-plaintext" value="<?php echo $tipo ?>">
                                </div>
                                <div class="col-sm-6">
                                    <strong>Periodo: </strong><input type="month" name="periodo"  style="width:70%!important;" id="inputMes" value="<?php echo $periodo ?>" readonly class="d-inline form-control-plaintext">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputInicial" class="sr-only">Nº Boleta Inicial</label>
                                <input type="number" name="inicial" id="inputInicial" class="form-control mr-3" placeholder="Nº Boleta Inicial" required>
                            </div>
                            <div class="form-group">
                                <label for="inputFinal" class="sr-only">Nº Boleta Final</label>
                                <input type="number" name="final" id="inputFinal" class="form-control mr-3" placeholder="Nº Boleta Final" required>
                            </div>
                            <div class="form-group">
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