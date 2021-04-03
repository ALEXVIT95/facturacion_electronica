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

        <h3 style="padding-left: 10px;">Lista de Productos</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">

            <?php
            include 'detalle_productos.php';
            include 'eliminar_productos.php';
            include 'agregar_productos.php';
            include 'editar_productos.php';
            ?>
            <a data-toggle="modal" data-target="#AgregarProductos" class="btn btn-success btn-sm" style="color: white;"> <i class="fa fa-plus"></i> Agregar Producto</a>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap contenido" style="width:100% ;">

                            <thead>
                            <tr>


                                <th scope="col">Codigo del Producto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Stock</th>
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
                "url": "<?php echo SERVERURL ?>controller/producto/listar_productoController.php",
            },
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            "columns": [
                {
                    "data": "PRO_CODIGO"
                },
                {
                    "data": "PRO_NOMBRE"
                },
                {
                    "data": "PRO_P_VENTA"
                },

                {
                    "data": "PRO_STOCK_MAX"
                },
                {
                    "data": "PRO_ESTADO"
                },


                {
                    "defaultContent": "<button type='button' data-toggle='modal' data-target='#DetalleProducto' class='detalle btn btn-primary btn-sm ' title='Detalle'><i class='fa fa-file-text' aria-hidden='true'></i> Detalle </button>  <button type='button' data-toggle='modal' data-target='#EditarProductos' class='edit btn btn-info btn-sm ' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar </button> <button type='button' data-toggle='modal' data-target='#EliminarProducto'  class='eliminar btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash' aria-hidden='true'></i> Eliminar  </button> "

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


        $("#btnGuardarProducto").on("click", function() {
            input = $(".nombreproducto").val();
            input2 = $(".codigo").val();
            input5 = $(".precio_c").val();
            input6 = $(".precio_v").val();
            input7 = $(".stockmin").val();
            input8 = $(".stockmax").val();
            input9 = $(".imgproducto").val();
            input10 = $(".pestado").val();
            input11 = $(".descproducto").val();
            if (input == 0|| input2 == 0 || input5 == 0 || input6 == 0 || input7 == 0 || input8 == 0 || input9 == 0 || input10 == 0 || input11 == 0) {
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

        $("#btnEditarProducto").on("click", function(e) {
            e.preventDefault();
            actualizar();


        })

        $("#btnEliminarProducto").on("click", function() {

            eliminar();

        })

        Obtener_Data_Editar("#tabla tbody", datatableInstance);
        Obtener_Id_Eliminar("#tabla tbody", datatableInstance);
        Obtener_Id_detalle("#tabla tbody", datatableInstance);
    });



    let Obtener_Data_Editar = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.edit', function() {
            var data = datatableInstance.row($(this).parents("tr")).data();
            // console.log(data);

            //Capturamos los valores de la base en cada campo de texto del modal editar

            let Eidproductos = $("#Eidproducto").val(data.PRO_ID),
                Enombresproducto = $("#Enombreproducto").val(data.PRO_NOMBRE),
                Ecodigo = $("#Ecodigo").val(data.PRO_CODIGO),
                Ev_categoria = $("#Ev_categoria").val(data.CA_ID).html(data.CA_DESCRIPCION),
                Ev_proveedor = $("#Ev_proveedor").val(data.PR_ID).html(data.PR_EMPRESA),
                Eprecio_c =  $("#Eprecio_c").val(data.PRO_P_COMPRA),
                Eprecio_v = $("#Eprecio_v").val(data.PRO_P_VENTA),
                Estockmin = $("#Estockmin").val(data.PRO_STOCK_MIN),
                Estockmax = $("#Estockmax").val(data.PRO_STOCK_MAX),
                Eimgproducto = $("#Eimgproducto").val(data.PRO_IMAGEN),
                EE_estado = $("#EE_estado ").val(data.PRO_ESTADO).html(data.PRO_ESTADO),
                Edescproducto = $("#Edescproducto").val(data.PRO_DESCRIPCION);



        });
    }

    let Obtener_Id_Eliminar = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.eliminar', function() {
            var data = datatableInstance.row($(this).parents('tr')).data();
            // console.log(data);
            let Elidproducto = $("#formEliminarProducto #Elidproducto").val(data.PRO_ID),
                Elnombresproducto = $("#Elnombresproducto").val(data.PRO_NOMBRE);

        });


    }

    let Obtener_Id_detalle = function(tbody, datatableInstance) {
        $(tbody).on('click', 'button.detalle', function() {
            var data = datatableInstance.row($(this).parents('tr')).data();
            // console.log(data);
            let Didproductos = $("#Eidproducto").val(data.PRO_ID),
                Dnombresproducto = $("#Dnombresproducto").val(data.PRO_NOMBRE),
                Dcodigo = $("#Dcodigo").val(data.PRO_CODIGO),
                Dv_categoria = $("#Dv_categoria").val(data.CA_DESCRIPCION),
                Dv_proveedor = $("#Dv_proveedor").val(data.PR_EMPRESA),
                Dprecio_c =  $("#Dprecio_c").val(data.PRO_P_COMPRA),
                Dprecio_v = $("#Dprecio_v").val(data.PRO_P_VENTA),
                Dstockmin = $("#Dstockmin").val(data.PRO_STOCK_MIN),
                Dstockmax = $("#Dstockmax").val(data.PRO_STOCK_MAX),
                Dimgproducto = $("#Dimgproducto").val(data.PRO_IMAGEN),
                DE_estado = $("#DE_estado ").val(data.PRO_ESTADO).html(data.PRO_ESTADO),
                Ddescproducto = $("#Ddescproducto").val(data.PRO_DESCRIPCION),
                Dfecha_c = $("#Dfecha_c").val(data.PRO_F_CREACION);

        });

        }
    //Funcion para verificar que la variable rs retorne true
    let grabar = function() {
        let url = "<?php echo SERVERURL ?>controller/producto/crud_productoController.php";
        let dataform = $("#formProductos").serialize();
        dataform = "accion=insertar&" + dataform;
        $.post(url, dataform).done((rs) => {
            console.log(rs)
            if (rs.success == true) {
                // alert("Registro guardado")
                $("#AgregarProductos").modal("hide");
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
        let urlE = "<?php echo SERVERURL ?>controller/producto/crud_productoController.php";
        let dataformEd = $("#formEditarProductos").serialize();
        dataformEd = "accion=actualizar&" + dataformEd;
        $.post(urlE, dataformEd).done((rsu) => {
            console.log(rsu)
            if (rsu.success == true) {
                // alert("Registro Modificado")

                $("#EditarProductos").modal('hide');
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
        let urlEl = "<?php echo SERVERURL ?>controller/producto/crud_productoController.php";
        let dataformEl = $("#formEliminarProducto").serialize();
        dataformEl = "accion=eliminar&" + dataformEl;
        $.post(urlEl, dataformEl).done((rse) => {
            console.log(rse)
            if (rse.success == true) {
                console.log(rse.success)
                // alert("Registro Elimiando")
                $("#EliminarProducto").modal("hide");
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