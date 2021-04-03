<div class="modal fade" id="DetalleProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list-alt" aria-hidden="true"></i> Eliminar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDetalleProducto" method="POST" action="<?php echo SERVERURL ?>controller/producto/listar_productoController.php">
                    <table class="default">
                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Codigo del Producto</th>

                        </tr>

                        <tr>

                            <td><input type="text" id="Dcodigo" name="Dcodigo" disabled></td>

                        </tr>

                        </tbody>

                        <tbody>

                        <tr>

                            <th colspan="2" scope="rowgroup">Nombre del Producto</th>

                        </tr>

                        <tr>

                            <td><input type="text" id="Dnombresproducto" name="Dnombresproducto" disabled></td>

                        </tr>

                        </tbody>

                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Descripcion del Producto</th>

                        </tr>

                        <tr>
                            <td><textarea type="text" id="Ddescproducto" name="Ddescproducto" disabled></textarea></td>

                        </tr>



                        </tbody>

                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Proveedor</th>

                        </tr>

                        <tr>


                            <td><input type="text" id="Dv_proveedor" name="Dv_proveedor" disabled></td>

                        </tr>



                        </tbody>

                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Categoria</th>

                        </tr>

                        <tr>


                            <td><input type="text" id="Dv_categoria" name="Dv_categoria" disabled></td>

                        </tr>

                        </tbody>
                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Precio Compra</th>

                        </tr>

                        <tr>


                            <td><input type="text" id="Dprecio_c" name="Dprecio_c" disabled></td>

                        </tr>

                        </tbody>
                        <tbody>

                        <tr>

                            <th colspan="3" scope="rowgroup">Precio De Venta</th>

                        </tr>

                        <tr>



                            <td><input type="text" id="Dprecio_v" name="Dprecio_v" disabled></td>

                        </tr>

                        </tbody>
                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Stock Minimo</th>

                        </tr>

                        <tr>



                            <td><input type="text" id="Dstockmin" name="Dstockmin" disabled></td>

                        </tr>

                        </tbody>
                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Stock Maximo</th>

                        </tr>

                        <tr>



                            <td><input type="text" id="Dstockmax" name="Dstockmax" disabled></td>

                        </tr>

                        </tbody>
                        <tbody>

                        <tr>

                            <th colspan="1" scope="rowgroup">Fecha de Creacion</th>

                        </tr>

                        <tr>



                            <td><input type="text" id="Dfecha_c" name="Dfecha_c" disabled></td>

                        </tr>

                        </tbody>

                    </table>

                                    <div class="col-md-3 col-sm-3  profile_left">
                                        <div class="profile_img">
                                            <div id="crop-avatar">
                                                <input id="Dimgproducto" name="Dimgproducto" onchange='cambiar()' type="text" style='display: none;'/>
                                                <div hidden id="info"></div>
                                                <img id="img" class="img-responsive avatar-view" src="" alt="Avatar" title="Change the avatar">
                                            </div>
                                        </div>
                                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>

            </div>
        </div>
        </form>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
            var reader = new FileReader(); //Leemos el contenido

            reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
                $('#img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#Dimgproducto").change(function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
        readURL(this);
    });
    function cambiar(){
        var pdrs = document.getElementById('Dimgproducto').files[0].name;
        document.getElementById('info').innerHTML = pdrs;
    }
</script>