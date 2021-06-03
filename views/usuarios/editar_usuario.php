<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
?>
<div class="modal fade" id="EditarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate  enctype="multipart/form-data" id="formEditarUsuario" method="POST" action="<?php echo SERVERURL ?>controller/usuario/crud_usuarioController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="edidUsuario" name="edidUsuario" >

                        <div class="form-group col-md-6">
                            <label for="ednombres">Nombres</label>
                            <input type="text" class="form-control ednombres input" id="ednombres" name="ednombres" placeholder="Ej: Juan " required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="edapellidos">Apellidos</label>
                            <input type="text" class="form-control edapellidos input" id="edapellidos" name="edapellidos" placeholder="Ej: Castro" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="edusuario">Usuario</label>
                            <input type="text" class="form-control edusuario input" id="edusuario" name="edusuario" placeholder="Ej: Juan123" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edcorreo">Correo Electrónico</label>
                            <input type="email" class="form-control edcorreo input" id="edcorreo" name="edcorreo" placeholder="Ej: ejempo@gmail.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="edclave">Contraseña</label>
                            <input type="password" class="form-control edclave input" id="edclave" name="edclave"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edconfirmarClave">Confirmar Contraseña</label>
                            <input type="password" class="form-control edconfirmarClave input" id="edconfirmarClave" name="edconfirmarClave"  required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="edrol">Rol</label>

                            <select class="form-control"  id="edrol" name="edrol">
                                <option selected  id="edRol_val" value="" >Seleccione una opcion</option>
                                <?php
                                $conn = $ob->Conexion();
                                $q = "SELECT * FROM tbl_rol WHERE RO_BORRADO = '0' AND RO_ESTADO ='A'";
                                $que = $conn->prepare($q);
                                $que->execute();
                                $result = $que->fetchAll();
                                foreach ($result  as $val) { ?>
                                    <option value="<?php echo $val['RO_ID'] ?>"><?php echo $val['RO_DESCRIPCION']  ?> </option>
                                <?php }  ?>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edtelef">Teléfono</label>
                            <input type="number" class="form-control" maxlength="11" id="edtelef" name="edtelef" placeholder="Ej: 0984575858" required>
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="edestado">Estado</label>
                            <select id="edestado" name="edestado" class="form-control input">
                                <option selected id="edEstado_val"  value="" >Seleccione una opción</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>


                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnEditarUsuario" id="btnEditarUsuario"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
            </div>
            </form>
        </div></div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="<?php echo SERVERURL ?>resources/js/jquery-1.10.2.min.js"></script>

