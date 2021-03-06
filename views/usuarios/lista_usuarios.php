<?php
session_start();
include '../../template/header.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SERVERURL ?>resources/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <title>Especialidades</title>

    <style>
        table th {
            background: #2A3F54;
            color: white;
        }

        .showHideColumn {
            cursor: pointer;
            color: blue;

        }
    </style>

</head>

<body>
<div class="page-title">
    <div class="title_left">
        <h3 style="padding-left: 10px;">Lista de Usuarios</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">


            <a data-toggle="modal" data-target="#AgregarUsuarioModal" class="btn btn-success btn-sm" style="color: white;"> <i class="fa fa-plus"></i> Agregar Usuario</a>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    include_once 'agregar_usuario.php';
                    include_once  'eliminar_usuario.php';
                    include_once  'editar_usuario.php';
                    ?>
                    <div class="card-box table-responsive">
                        <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap contenido" style="width:100% ;">

                            <thead>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>

                                <th scope="col">Estado</th>
                                <th scope="col" data-priority>Acciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo SERVERURL ?>resources/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo SERVERURL ?>resources/jquery/jquery.min.js"></script>
<script>
    //llamamos al ID de la tabla para usar DataTable JQuery
    $(document).ready(function() {

        let datatableInstance = $('#tabla').DataTable({
            // cargamos los datos Json con ajax
            "ajax": {
                "url": "<?php echo SERVERURL ?>controller/usuario/lista_usuariosController.php",
            },
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            "columns": [
                {
                    "data": "USU_ID"
                },
                {
                    "data": "USU_NOMBRES"
                },
                {
                    "data": "USU_APELLIDOS"
                },

                {
                    "data": "USU_USUARIO"
                },
                {
                    "data": "USU_CORREO"
                },
                {
                    "data": "RO_DESCRIPCION"
                },
                {
                    "data": "USU_ESTADO"
                },

                {
                    "defaultContent": " <button type='button' data-toggle='modal' data-target='#EditarUsuarioModal' class='edit btn btn-info btn-sm ' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar </button>  <button type='button' data-toggle='modal' data-target='#EliminarUsuariomodal'  class='eliminar btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash' aria-hidden='true'></i> Eliminar  </button> "

                }

            ],

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            responsive: true,


        });



        //Escojemos la clase showHideColumn para mostrar u ocultar las columnas
        //cuando se haga click
        /*   $('.showHideColumn').on('click', function() {
               var tableColumn = datatableInstance.column($(this).attr('data-columindex'));
               tableColumn.visible(!tableColumn.visible());
           });*/


        //Llamamos a la funcion grabar


        $("#btnGuardarUsuario").on("click", function() {
            input = $(".nombres").val();
            input2 = $(".apellidos").val();
            if (input == 0 || input2 == 0) {
                Swal.fire({
                    title: 'Advertencia',
                    icon: 'warning',
                    text: 'Todos los campos son requeridos',
                    showCloseButton: true

                })
                // alert("Todos los campos son requeridos")
            } else {
                grabar();
            }
        })

        $("#btnEditarUsuario").on("click", function(e) {
            e.preventDefault();
            actualizar();
            window.location.reload(null, false);

        })

        $("#btnEliminarUsuario").on("click", function() {

            eliminar();

        })

       Obtener_Data_Editar("#tabla tbody", datatableInstance);
        Obtener_Id_Eliminar("#tabla tbody", datatableInstance);

    });



    let Obtener_Data_Editar = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.edit', function() {
            var data = datatableInstance.row($(this).parents("tr")).data();
            // console.log(data);

            //Capturamos los valores de la base en cada campo de texto del modal editar

            let edidusuario = $("#edidUsuario").val(data.USU_ID),
                ednombres = $("#ednombres").val(data.USU_NOMBRES),
                edapellidos = $("#edapellidos").val(data.USU_APELLIDOS),
                edusuario = $("#edusuario").val(data.USU_USUARIO),
                edclave = $("#edclave").val(data.USU_CLAVE),
                edconfirmarclave = $("#edconfirmarClave").val(data.USU_CLAVE),
                edcorreo = $("#edcorreo").val(data.USU_CORREO),
                edrol = $("#edRol_val ").val(data.RO_ID).html(data.RO_DESCRIPCION),
                edestado = $("#edEstado_val").val(data.USU_ESTADO).html(data.USU_ESTADO);




        });
    }

   let Obtener_Id_Eliminar = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.eliminar', function() {
            var data = datatableInstance.row($(this).parents('tr')).data();
            // console.log(data);
            let elidusuario = $("#formEliminarUsuario #idUsuarioEl").val(data.USU_ID),
                elnombres = $("#Elnombres").val(data.USU_NOMBRES);

        });
    }
    //Funcion para verificar que la variable rs retorne true
    let grabar = function() {
        let url = "../../controller/usuario/crud_usuarioController.php";
        let dataform = $("#formUsuario").serialize();
        dataform = "accion=insertar&" + dataform;
        $.post(url, dataform).done((rs) => {
            console.log(rs)
            if (rs.success == true) {
                // alert("Registro guardado")
                $("#AgregarUsuarioModalModal").modal("hide");
                Swal.fire(
                    'Correcto!',
                    'Registro guardado!',
                    'success'
                );
                $(".input").val("");
                window.location.reload(null, false);


            } else {
                alert("Ocurrio un error")
                console.log(rs.mensaje)
            }
        })
    }

    let actualizar = function() {
        let urlE = "<?php echo SERVERURL ?>controller/usuario/crud_usuarioController.php";
        let dataformEd = $("#formEditarUsuario").serialize();
        dataformEd = "accion=actualizar&" + dataformEd;
        $.post(urlE, dataformEd).done((rsu) => {
            console.log(rsu)
            if (rsu.success == true) {
                // alert("Registro Modificado")

                $("#EditarUsuarioModal").modal('hide');
                Swal.fire(
                    'Correcto!',
                    'Registro Modificado!',
                    'success'
                );
                //location.reload();

                console.log(rsu.success)

            } else {
                console.log(rsu.mensaje)
            }
        })
    }

    let eliminar = function() {
        let urlEl = "<?php echo SERVERURL ?>controller/usuario/crud_usuarioController.php";
        let dataformEl = $("#formEliminarUsuario").serialize();
        dataformEl = "accion=eliminar&" + dataformEl;
        $.post(urlEl, dataformEl).done((rse) => {
            console.log(rse)
            if (rse.success == true) {
                console.log(rse.success)
                // alert("Registro Elimiando")
                $("#EliminarUsuariomodal").modal("hide");
                Swal.fire(
                    'Correcto!',
                    'Registro Eliminado!',
                    'success'
                );
                window.location.reload(null, false);
            } else {
                console.log(rse.mensaje)
            }
        })
    }


</script>

</body>

</html>
<?php
include '../../template/footer.php';
?>