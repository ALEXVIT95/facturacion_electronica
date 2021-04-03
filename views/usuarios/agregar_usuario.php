<style>
    .subir{
        padding: 5px 10px;
        background: #0C9A9A;
        color:#fff;
        border:0px solid #0d89ed;
    }

    .subir:hover{
        color:#fff;
        background: #f7cb15;
    }
</style>

<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
?>
<div class="modal fade" id="AgregarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  novalidate  enctype="multipart/form-data" id="formUsuario" method="POST" action="<?php echo SERVERURL ?>controller/usuario/crud_usuarioController.php">
                    <div class="form-row">
                        <input type="hidden" class="form-control"  id="idUsuario" name="idUsuario" >

                        <div class="form-group col-md-6">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control nombres input" id="nombres" name="nombres" placeholder="Ej: Juan " required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control apellidos input" id="apellidos" name="apellidos" placeholder="Ej: Castro" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control input" id="usuario" name="usuario" placeholder="Ej: Juan123" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="correo">Correo Electrónico</label>
                            <input type="email" class="form-control input" id="correo" name="correo" placeholder="Ej: ejempo@gmail.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="clave">Contraseña</label>
                            <input type="password" class="form-control input" id="clave" name="clave"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmarClave">Confirmar Contraseña</label>
                            <input type="password" class="form-control input" id="confirmarClave" name="confirmarClave"  required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="rol">Rol</label>

                            <select class="form-control"  id="rol" name="rol">
                                <option selected  id="Rol_val" value="" >Seleccione una opcion</option>
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
                            <label for="telef">Teléfono</label>
                            <input type="number" class="form-control" maxlength="11" id="telef" name="telef" placeholder="Ej: 0984575858" required>
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control input">
                                <option selected id="Estado_val"  value="" >Seleccione una opción</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">

                            <div class="profile_pic">
                                <label for="Perfil">Perfil</label>
                        <br>
                        <label for="file" class="subir">
                            <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                        </label>
                        <input id="file" name="photo" onchange='cambiar()' type="file" style='display: none;'/>
                        <div hidden id="info"></div>

                            </div>
                            <div class="form-group col-md-6"><img id="img" class="img-circle profile_img" src="../../archive/imgen/user.png" height="100" width="100"  "></div>
                    </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" name="btnGuardarUsuario" id="btnGuardarUsuario"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
            </form>
        </div></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="<?php echo SERVERURL ?>resources/js/jquery-1.10.2.min.js"></script>
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

    $("#file").change(function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
        readURL(this);
    });
    function cambiar(){
        var pdrs = document.getElementById('photo').files[0].name;
        document.getElementById('info').innerHTML = pdrs;
    }
</script>
<script>

</script>