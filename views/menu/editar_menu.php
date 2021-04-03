<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
?>

<div class="modal fade" id="EditarMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list-alt" aria-hidden="true"></i> Editar Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formEditarMenu" method="POST" action="<?php echo SERVERURL ?>controller/menu/crud_menuController.php">
                    <div class="form-row">



                        <div class="form-group col-md-6">
                            <label for="nombres">Nombre</label>
                            <input type="hidden" class="form-control "  id="EidMenu" name="EidMenu" placeholder="Ej: Juan " >

                            <input type="text" class="form-control Enombres input" id="Enombres" name="Enombres" placeholder="Ej: Juan " >

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Eicono">Icono</label>
                            <input type="text" class="form-control Eicono input" id="Eicono" name="Eicono" placeholder="Ej: Castro" >
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="Ed_rol">Rol</label>

                            <select class="form-control selectpicker" data-live-search="true"  name="Ed_rol" id="Ed_rol">

                                <option selected="" id="Ed_rol_val" value="">Seleccione una opcion</option>
                                <?php
                                $conn = $ob->Conexion();
                                $q = "SELECT * FROM tbl_rol";
                                $que = $conn->prepare($q);
                                $que->execute();
                                $result = $que->fetchAll();

                                foreach ($result   as $val)  {
                                    echo ' <option value="' . $val['RO_ID'] . '">' . $val['RO_DESCRIPCION'] . '</option>';
                                }
                                ?>
                            </select>



                        </div>

                        <div class="form-group col-md-6">
                            <label for="Eestado">Estado</label>
                            <select id="Eestado" name="Eestado" class="form-control " >
                                <option selected id="E_t_estado_val" >Seleccione una opción</option>
                                <option value="<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>">Activo</option>
                                <option value="<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>">Inactivo</option>

                            </select>
                        </div>

                    </div>







            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnEditarMenu" id="btnEditarMenu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
