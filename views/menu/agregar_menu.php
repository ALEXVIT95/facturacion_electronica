<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
?>
<div class="modal fade" id="AgregarMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Agregar Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formMenu" method="POST" action="<?php echo SERVERURL ?>controller/menu/crud_menuController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="idMenu" name="idMenu" >

                        <div class="form-group col-md-6">
                            <label for="nombres">Nombre</label>
                            <input type="text" class="form-control nombres input" id="nombres" name="nombres" placeholder="Ej: Inicio " required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="icono">Icono</label>
                            <input type="text" class="form-control icono input" id="icono" name="icono" placeholder="Ej: fa fa-user" required>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="rol">Rol</label>

                            <select class="form-control"  id="rol" name="rol">
                                <option selected  id="rol" value="" >Seleccione una opcion</option>
                                <?php

                                $conn = $ob->Conexion();
                                $q = "SELECT RO_ID, RO_DESCRIPCION FROM tbl_rol";
                                $que = $conn->prepare($q);
                                $que->execute();
                                $result = $que->fetchAll();

                                foreach ($result   as $val) { ?>
                                    <option value="<?php echo $val['RO_ID'] ?>"><?php echo $val['RO_DESCRIPCION']  ?> </option>
                                <?php }  ?>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control input">
                                <option selected id="E_estado"  value="" >Seleccione una opción</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>

                            </select>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnGuardarMenu" id="btnGuardarMenu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
