    <?php
    session_start();
    include '../../template/header.php';
    ?>

    <div class="page-title">
        <div class="title_left">
            <h3><a><i class="fa fa-gear"></i> Ajustes</a></h3>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Cambiar Contraseña </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="clave_actual">Contraseña Actual
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="clave_actual" name="clave_actual" required="required"
                                       class="form-control ">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="clave_nueva">Contraseña
                                nueva<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="clave_nueva" name="clave_nueva" required="required"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="Verificar_clave" class="col-form-label col-md-3 col-sm-3 label-align">Verificar
                                Contraseña <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="Verificar_clave" class="form-control" type="password" name="Verificar_clave">
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">

                                <button type="submit" class="  btn btn-success "><i class="fa fa-save" aria-hidden="true"></i> Cambiar Contraseña</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../../template/footer.php';
    ?>