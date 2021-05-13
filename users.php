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

// LISTADO DE USUARIOS

$lista_u;

$sql_getall='SELECT * FROM usuarios';
$db = new db();
$db = $db->connDB();
$lista_u = $db->query($sql_getall);

$xpage = isset($_POST['xpage']) ? $_POST['xpage'] : 25;
$total_u = $lista_u->rowCount();
$pages = $total_u/$xpage;
$pages = ceil($pages);

if(isset($_GET['p'])) {
    $pagina = $_GET['p'];
}else{
    header("location:users.php?p=1");
}
 
if($pagina > $pages){
    header("location:users.php?p=".$pages);
}
if($pagina < 1){
    header("location:users.php?p=1");
}


?>
<div class="container mt-3">
    <h2>Usuarios</h2>
    <hr class="my-3">
    <div class="tools mb-3 row mx-0">
        <div id="regboton" class="col-sm-auto">
            <a href="register.php" class="btn btn-light d-inline"><i class="fas fa-plus mr-2"></i>Nuevo</a>  
        </div>
        <div class="col-sm-auto">
            <form action="users.php" method="POST" class="form-horizontal">
                <select name="xpage" id="xpage" class="form-control ">
                    <option value="25" selected>25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">RUT</th>
                <th scope="col" class="d-none d-md-table-cell">Email</th>
                <th scope="col" class="d-none d-md-table-cell">Rol</th>
                <th scope="col" class="d-none d-md-table-cell">Registrado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($lista_u as $u) { ?>
                <tr>
                    <th scope="row"><?php echo $u['id'];?></th>
                    <td><?php echo $u['usuario'];?></td>
                    <td><?php echo $u['nombre'];?></td>
                    <td><?php echo $u['rut'];?></td>
                    <td class="d-none d-md-table-cell"><?php echo $u['email'];?></td>
                    <td class="d-none d-md-table-cell"><?php if($u['tipo'] == 1) {echo 'Usuario';} else{ echo 'Administrador';} ?></td>
                    <td class="d-none d-md-table-cell"><?php echo $u['fecha'];?></td>
                    <td><span class="btn btn-light" data-toggle="modal" data-target="#editUserModal<?php echo $u['id'];?>"><i class="fas fa-user-edit"></i></span><span class="btn btn-light" data-toggle="modal" data-target="#deleteUserModal<?php echo $u['id'];?>"><i class="fas fa-user-times"></i></span> </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editUserModal<?php echo $u['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="users.php" method="POST" class="form-signin">
                                    <input name="e_id" type="hidden" value="<?php echo $u['id']; ?> ">
                                    
                                    <label for="inputNombre" class="sr-only">Nombre</label>
                                    <div class="input-group flex-nowrap mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Nombre</span>
                                        </div>
                                        <input name="e_nombre" type="text" id="inputNombre" class="form-control" placeholder="Nombre" required="" value="<?php echo $u['nombre'];?>" aria-describedby="addon-wrapping">
                                    </div>
                                    
                                    <label for="inputRut" class="sr-only">RUT</label>
                                    <div class="input-group flex-nowrap mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">RUT</span>
                                        </div>
                                        <input name="e_rut" type="text" id="inputRut" class="form-control" placeholder="RUT" required="" value="<?php echo $u['rut'];?>" aria-describedby="addon-wrapping">
                                    </div>

                                    <label for="inputEmail" class="sr-only">Email</label>
                                    <div class="input-group flex-nowrap mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Email</span>
                                        </div>
                                        <input name="e_email" type="email" id="inputEmail" class="form-control" placeholder="Email" required="" value="<?php echo $u['email'];?>" aria-describedby="addon-wrapping">
                                    </div>
                                    
                                    <label for="inputPassword" class="sr-only">Password Actual</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Password</span>
                                        </div>
                                        <input name="e_pass" type="text" id="inputPassword" class="form-control" placeholder="Password" required="" value="<?php echo $u['pass'];?>">
                                    </div>
                                    
                                    <hr class="my-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Rol</span>
                                        </div>
                                        <select name="e_tipo" class="form-control" id="tipoUsuario" <?php if($u['id'] == $usuario ['id']) echo 'readonly'?>>
                                            <option value="1" <?php if($u['tipo'] == 1)echo 'selected'?> >Usuario</option>
                                            <option value="2" <?php if($u['tipo'] == 2)echo 'selected'?> >Administrador</option>
                                        </select>
                                    </div>
                                    
                                    <button class="btn btn-lg btn-primary btn-block" name="edit" type="submit">Guardar</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteUserModal<?php echo $u['id'];?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModalLabel">Eliminar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="text-center mb-3">
                                    <strong>Usuario:</strong> <?php echo $u['usuario']; ?>
                                </div>
                                <form action="users.php" method="POST" class="form-signin">
                                    <input type="hidden" name="d_id" value="<?php echo $u['id'];?>" >
                                    <button type="submit" name="delete" class="btn btn-danger btn-block" <?php if($u['id'] == $usuario ['id']) echo 'disabled=""'?>>Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?> 
            </tbody>
        </table>
        <hr class="mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($pagina == 1)echo 'disabled '; ?>">
                    <a class="page-link" href="users.php?p=<?php echo $pagina-1;  ?>" aria-label="Anterior" >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i=0; $i < $pages ; $i++) { ?>
                    <li class="page-item  <?php echo $pagina == $i+1 ? 'active' : ''?> "><a class="page-link" href="users.php?p=<?php echo $i+1 ?>"><?php echo $i+1; ?></a></li>
                    <?php }?>
                    
                    <li class="page-item <?php if($pagina == $pages){echo 'disabled ';}?>">
                        <a class="page-link " href="users.php?p=<?php echo $pagina+1;  ?>" aria-label="Next" >
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php include 'includes/footer.php'?>
        
        
        