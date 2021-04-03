

<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
?>
<div class="modal fade" id="EditarsubMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list-alt" aria-hidden="true"></i> Editar Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formEditarsubMenu" method="POST" action="<?php echo SERVERURL ?>controller/submenu/crud_submenuController.php">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="nombres">Nombre</label>
                            <input type="hidden" class="form-control "  id="EidsubMenu" name="EidsubMenu" placeholder="Ej: Inicio " >

                            <input type="text" class="form-control Enombres input" id="Esnombres" name="Esnombres" placeholder="Ej: Inicio " >

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Esurl">Esurl</label>
                            <input type="text" class="form-control Eurl input" id="Esurl" name="Esurl" placeholder="Ej: Castro" >
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="Ed_rol">Rol</label>

                            <select class="form-control " name="Ed_rol" id="Ed_rol">

                                <option selected="" id="Ed_rol_val" value="0">Seleccione una opcion</option>
                                <?php
                                $conn = $ob->Conexion();
                                $q = "SELECT RO_ID, RO_DESCRIPCION FROM tbl_rol";
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
                                <label for="Ed_menu">Menu</label>
                                <select id="Ed_menu" name="Ed_menu" class="form-control input">
                                    <option selected  id="Ed_menu_val" value="" >Seleccione una opcion</option>


                                </select>
                            </div>
                        <div class="form-group col-md-6">
                            <label for="Edsestado">Estado</label>
                            <select id="Edsestado" name="Edsestado" class="form-control input">
                                <option selected id="Ed_sestado_val"  value="" >Seleccione una opción</option>
                                <option value="<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>">Activo</option>
                                <option value="<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>">Inactivo</option>

                            </select>
                        </div>
                        </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnEditarsubMenu" id="btnEditarsubMenu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo SERVERURL ?>resources/js/jquery-1.10.2.min.js"></script>
<script>

    $(document).ready(function(){

        var calle = $('#Ed_menu');

        $('#Ed_rol').change(function(){
            var Ed_rol = $(this).val();

            $.ajax({
                data: {Ed_rol:Ed_rol},
                dataType: 'html',
                type: 'POST',
                url: '../../controller/submenu/obtener_selectrol.php',

            }).done(function(data){
                calle.html(data);
            });

        });

    });
</script>