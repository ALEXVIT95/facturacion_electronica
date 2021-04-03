<?php
include_once '../../model/conexion.php';
error_reporting(0);
$ob = new Conectar();
?>
<div class="modal fade" id="EditarProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Editar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formEditarProductos" method="POST" action="<?php echo SERVERURL ?>controller/producto/crud_productoController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="Eidproducto" name="Eidproducto" >

                        <div class="form-group col-md-6">
                            <label for="Enombreproducto">Nombre</label>
                            <input type="text" class="form-control nombreproducto input" id="Enombreproducto" name="Enombreproducto" placeholder="Ej: Producto 1 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Ecodigo">Codigo del Producto</label>
                            <input type="text" class="form-control codigo input" id="Ecodigo" name="Ecodigo" placeholder="Ej: 1234567890" required="">
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="Eid_categoria">Categoria</label>

                            <select class="form-control"  id="Eid_categoria" name="Eid_categoria" required="">
                                <option selected  id="Ev_categoria" value="0" >Seleccione una opcion</option>
                                <?php

                                $conn = $ob->Conexion();
                                $q = "SELECT CA_ID, CA_DESCRIPCION FROM tbl_categorias WHERE CA_ESTADO='A' AND CA_BORRADO='0'";
                                $que = $conn->prepare($q);
                                $que->execute();
                                $result = $que->fetchAll();

                                foreach ($result   as $val) { ?>
                                    <option value="<?php echo $val['CA_ID'] ?>"><?php echo $val['CA_DESCRIPCION']  ?> </option>
                                <?php }  ?>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Eproveedor">Proveedor</label>
                            <select id="Eproveedor" name="Eproveedor" class="form-control input">
                                <option selected  id="Ev_proveedor" value="0" >Seleccione una opcion</option>

                                <?php

                                $conn = $ob->Conexion();
                                $q = "SELECT PR_ID, PR_EMPRESA FROM tbl_proveedor WHERE PR_ESTADO = 'A'";
                                $que = $conn->prepare($q);
                                $que->execute();
                                $result = $que->fetchAll();

                                foreach ($result   as $val) { ?>
                                    <option value="<?php echo $val['PR_ID'] ?>"><?php echo $val['PR_EMPRESA']  ?> </option>
                                <?php }  ?>
                            </select>
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Eprecio_c">Precio Crompra</label>
                                <input type="number" class="form-control precio_c input" id="Eprecio_c" name="Eprecio_c" placeholder="Ej: 100.00 " required="">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="Eprecio_v">Precio Venta</label>
                                <input type="number" class="form-control precio_v input" id="Eprecio_v" name="Eprecio_v" placeholder="Ej: 200.00" required="">
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Estockmin">Stock Minimo</label>
                            <input type="number" class="form-control stockmin input" id="Estockmin" name="Estockmin" placeholder="Ej: 5 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Estockmax">Stock Maximo</label>
                            <input type="number" class="form-control stockmax input" id="Estockmax" name="Estockmax" placeholder="Ej: 10" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Eimgproducto">Imagen del Producto</label>
                            <input type="text" class="form-control imgproducto input" id="Eimgproducto" name="Eimgproducto" placeholder="Link de la imagen " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Epestado">Estado</label>
                            <select id="Epestado" name="Epestado" class="form-control input">
                                <option selected id="EE_estado"  value="0" >Seleccione una opción</option>
                                <option value="<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>">Activo</option>
                                <option value="<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>">Inactivo</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">


                                <label for="Edescproducto">Descripcion</label>
                                <textarea  class="form-control descproducto input" id="Edescproducto" name="Edescproducto" placeholder="Detalle el producto " required=""></textarea>
                            </div>
                        </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"  ></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnEditarProducto" id="btnEditarProducto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    
</script>