<?php
include_once '../../model/conexion.php';
error_reporting(0);
$ob = new Conectar();
?>
<div class="modal fade" id="AgregarsubMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Agregar Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formsubMenu" method="POST" action="<?php echo SERVERURL ?>controller/menu/crud_menuController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="idsubMenu" name="idsubMenu" >

                        <div class="form-group col-md-6">
                            <label for="nombres">Nombre</label>
                            <input type="text" class="form-control snombres input" id="snombres" name="snombres" placeholder="Ej: Inicio " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="surl">Url</label>
                            <input type="text" class="form-control surl input" id="surl" name="surl" placeholder="Ej: views/clientes/lista_clientes.php" required="">
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="id_rol">Rol</label>

                            <select class="form-control"  id="id_rol" name="rol" required="">
                                <option selected  id="id_rol" value="0" >Seleccione una opcion</option>
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
                            <label for="menu">Menu</label>
                            <select id="menu" name="menu" class="form-control input">
                                <option selected  id="menu" value="0" >Seleccione una opcion</option>


                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sestado">Estado</label>
                            <select id="sestado" name="sestado" class="form-control input">
                                <option selected id="E_estado"  value="0" >Seleccione una opción</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>

                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"  ></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnGuardarsubMenu" id="btnGuardarsubMenu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="../../resources/js/jquery-1.10.2.min.js"></script>
<script>

    $(document).ready(function(){

        var calle = $('#menu');

        $('#id_rol').change(function(){
            var id_rol = $(this).val();

            $.ajax({
                data: {id_rol:id_rol},
                dataType: 'html',
                type: 'POST',
                url: '../../controller/submenu/obtener_selectrol.php',

            }).done(function(data){
                calle.html(data);
            });

        });

    });


</script>