<?php
session_start();
include_once '../../template/header.php';

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SERVERURL ?>resources/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <title>Configuraciones</title>

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

<body  >
<div class="page-title">
    <div class="title_left">

        <h3 style="padding-left: 10px;">Lista de Servicios</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">

            <?php
            include 'agregar_servicio.php';
            include 'editar_servicio.php';
            include 'eliminar_servicio.php';

            ?>
            <a data-toggle="modal" data-target="#AgregarServicio" class="btn btn-success btn-sm" style="color: white;"> <i class="fa fa-plus"></i> Agregar Servicio</a>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap contenido" style="width:100% ;">

                            <thead>
                            <tr>


                                <th scope="col">Codigo del Servicio</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
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
                "url": "<?php echo SERVERURL ?>controller/servicio/listar_servicioController.php",
            },
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            "columns": [
                {
                    "data": "SER_COD_AUX"
                },
                {
                    "data": "SER_NOMBRE"
                },
                {
                    "data": "SER_P_VENTA"
                },

                {
                    "data": "SER_ESTADO"
                },


                {
                    "defaultContent": " <button type='button' data-toggle='modal' data-target='#EditarServicio' class='edit btn btn-info btn-sm ' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar </button> <button type='button' data-toggle='modal' data-target='#EliminarServicio'  class='eliminar btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash' aria-hidden='true'></i> Eliminar  </button> "

                }

            ],

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },

            responsive: true,


        });





        $("#btnGuardarServicio").on("click", function() {
            input = $(".nombreservicio").val();
            input2 = $(".scodigo").val();
            input3 = $(".sprecio_v").val();
            input4 = $(".sestado").val();
            input5 = $(".descservicio").val();
            if (input == 0|| input2 == 0 || input3 == 0 || input4 == 0 || input5 == 0) {
                Swal.fire({
                    title: 'Advertencia',
                    icon: 'warning',
                    text: 'Todos los campos son requeridos',
                    showCloseButton: true

                })


            } else {
                grabar();
            }
        })

        $("#btnEditarServicio").on("click", function(e) {
            e.preventDefault();
            actualizar();


        })

        $("#btnEliminarServicio").on("click", function() {

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

            let Eidservicio = $("#Eidservicio").val(data.SER_ID),
                Enombreservicio = $("#Enombreservicio").val(data.SER_NOMBRE),
                Escodigo = $("#Escodigo").val(data.SER_COD_AUX),
                Esprecio_v = $("#Esprecio_v").val(data.SER_P_VENTA),
                EEs_estado = $("#EEs_estado ").val(data.SER_ESTADO).html(data.SER_ESTADO),
                Edescservicio = $("#Edescservicio").val(data.SER_DESCRIPCION);



        });
    }

    let Obtener_Id_Eliminar = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.eliminar', function() {
            var data = datatableInstance.row($(this).parents('tr')).data();
            // console.log(data);
            let Elidservicio = $("#formEliminarServicio #Elidservicio").val(data.SER_ID);

        });


    }



    //Funcion para verificar que la variable rs retorne true
    let grabar = function() {
        let url = "<?php echo SERVERURL ?>controller/servicio/crud_servicioController.php";
        let dataform = $("#formServicio").serialize();
        dataform = "accion=insertar&" + dataform;
        $.post(url, dataform).done((rs) => {
            console.log(rs)
            if (rs.success == true) {
                // alert("Registro guardado")
                $("#AgregarServicio").modal("hide");
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
        let urlE = "<?php echo SERVERURL ?>controller/servicio/crud_servicioController.php";
        let dataformEd = $("#formEditarServicio").serialize();
        dataformEd = "accion=actualizar&" + dataformEd;
        $.post(urlE, dataformEd).done((rsu) => {
            console.log(rsu)
            if (rsu.success == true) {
                // alert("Registro Modificado")

                $("#EditarServicio").modal('hide');
                Swal.fire(
                    'Correcto!',
                    'Registro Modificado!',
                    'success'
                );
                //location.reload();

                console.log(rsu.success)
                window.location.reload(null, false);
            } else {
                console.log(rsu.mensaje)
            }
        })
    }

    let eliminar = function() {
        let urlEl = "<?php echo SERVERURL ?>controller/servicio/crud_servicioController.php";
        let dataformEl = $("#formEliminarServicio").serialize();
        dataformEl = "accion=eliminar&" + dataformEl;
        $.post(urlEl, dataformEl).done((rse) => {
            console.log(rse)
            if (rse.success == true) {
                console.log(rse.success)
                // alert("Registro Elimiando")
                $("#EliminarServicio").modal("hide");
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
