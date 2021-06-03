<?php
include_once '../../model/conexion.php';
error_reporting(0);
$ob = new Conectar();
?>
<div class="modal fade" id="EditarServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formEditarServicio" method="POST" action="<?php echo SERVERURL ?>controller/servicio/crud_servicioController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="Eidservicio" name="Eidservicio" >

                        <div class="form-group col-md-6">
                            <label for="Enombreservicio">Nombre</label>
                            <input type="text" class="form-control Enombreservicio input" id="Enombreservicio" name="Enombreservicio" placeholder="Ej: Servicio 1 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Escodigo">Codigo del Servicio</label>
                            <input type="text" class="form-control Escodigo input" id="Escodigo" name="Escodigo" placeholder="Ej: 1234567890" required="">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="Esprecio_v">Precio Venta</label>
                            <input type="number" class="form-control Esprecio_v input" id="Esprecio_v" name="Esprecio_v" placeholder="Ej: 200.00" required="">
                        </div>



                        <div class="form-group col-md-6">
                            <label for="Esestado">Estado</label>
                            <select id="Esestado" name="Esestado" class="form-control input">
                                <option selected id="EEs_estado"  value="0" >Seleccione una opción</option>
                                <option value="<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>">Activo</option>
                                <option value="<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>">Inactivo</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">


                            <label for="Edescservicio">Descripcion</label>
                            <textarea  class="form-control Edescservicio input" id="Edescservicio" name="Edescservicio" placeholder="Detalle del servicio " required=""></textarea>
                        </div>
                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"  ></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnEditarServicio" id="btnEditarServicio"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>