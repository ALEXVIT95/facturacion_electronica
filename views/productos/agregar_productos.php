<?php
include_once '../../model/conexion.php';
error_reporting(0);
$ob = new Conectar();
?>
<div class="modal fade" id="AgregarProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa  fa-list-alt" aria-hidden="true"></i> &nbsp; Agregar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate enctype="multipart/form-data" id="formProductos" method="POST" action="<?php echo SERVERURL ?>controller/producto/crud_productoController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="idproducto" name="idproducto" >

                        <div class="form-group col-md-6">
                            <label for="nombreproducto">Nombre</label>
                            <input type="text" class="form-control nombreproducto input" id="nombreproducto" name="nombreproducto" placeholder="Ej: Producto 1 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="codigo">Codigo del Producto</label>
                            <input type="text" class="form-control codigo input" id="codigo" name="codigo" placeholder="Ej: 1234567890" required="">
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="id_categoria">Categoria</label>

                            <select class="form-control"  id="id_categoria" name="id_categoria" required="">
                                <option selected  id="v_categoria" value="0" >Seleccione una opcion</option>
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
                            <label for="proveedor">Proveedor</label>
                            <select id="proveedor" name="proveedor" class="form-control input">
                                <option selected  id="v_proveedor" value="0" >Seleccione una opcion</option>

                                <?php

                                $conn = $ob->Conexion();
                                $q = "SELECT PR_ID, PR_EMPRESA FROM tbl_proveedor";
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
                                <label for="precio_c">Precio Crompra</label>
                                <input type="number" class="form-control precio_c input" id="precio_c" name="precio_c" placeholder="Ej: 100.00 " required="">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="precio_v">Precio Venta</label>
                                <input type="number" class="form-control precio_v input" id="precio_v" name="precio_v" placeholder="Ej: 200.00" required="">
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="stockmin">Stock Minimo</label>
                            <input type="number" class="form-control stockmin input" id="stockmin" name="stockmin" placeholder="Ej: 5 " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="stockmax">Stock Maximo</label>
                            <input type="number" class="form-control stockmax input" id="stockmax" name="stockmax" placeholder="Ej: 10" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="imgproducto">Imagen del Producto</label>
                            <input type="text" class="form-control imgproducto input" id="imgproducto" name="imgproducto" placeholder="Link de la imagen " required="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="pestado">Estado</label>
                            <select id="pestado" name="pestado" class="form-control input">
                                <option selected id="E_estado"  value="0" >Seleccione una opción</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">


                                <label for="descproducto">Descripcion</label>
                                <textarea  class="form-control descproducto input" id="descproducto" name="descproducto" placeholder="Detalle el producto " required=""></textarea>
                            </div>
                        </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"  ></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnGuardarProducto" id="btnGuardarProducto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    
</script>