<?php
include_once '../../model/conexion.php';
error_reporting(0);
$ob = new Conectar();
?>
<div class="modal fade" id="AgregarServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Agregar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formServicio" method="POST" action="<?php echo SERVERURL ?>controller/servicio/crud_servicioController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="idservicio" name="idservicio" >

                        <div class="form-group col-md-6">
                            <label for="nombreservicio">Nombre</label>
                            <input type="text" class="form-control nombreservicio input" id="nombreservicio" name="nombreservicio" placeholder="Ej: Servicio 1 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="scodigo">Codigo del Producto</label>
                            <input type="text" class="form-control scodigo input" id="scodigo" name="scodigo" placeholder="Ej: 1234567890" required="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sprecio_v">Precio Venta</label>
                            <input type="number" class="form-control sprecio_v input" id="sprecio_v" name="sprecio_v" placeholder="Ej: 200.00" required="">
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
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <div class="form-row">
                            <label for="descservicio">Descripcion</label>
                            <textarea  class="form-control descservicio input" id="descservicio" name="descservicio" placeholder="Detalle del servicio " required=""></textarea>
                        </div>
                    </div>

        </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"  ></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnGuardarServicio" id="btnGuardarServicio"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>