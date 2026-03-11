<!-- Encabezados -->
<?php include "encabezado.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de Préstamos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#" id="btn_nuevo_prestamo">Nuevo</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Préstamos</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form parametros de buqueda start -->
                        <form id="form-prestamos">
                            <div class="card-body pb-1">
                                <!-- Filtros básicos (se pueden extender luego) -->
                                <div class="row">
                                    <!-- Desde -->
                                    <div class="form-group col-md-2">
                                        <label for="desde">de Fecha</label>
                                        <input type="date" class="form-control fv-fecha" name="desde" id="desde" placeholder="Desde">
                                    </div>
                                    <!-- Hasta -->
                                    <div class="form-group col-md-2">
                                        <label for="hasta">a Fecha</label>
                                        <input type="date" class="form-control fv-fecha" name="hasta" id="hasta" placeholder="Hasta">
                                    </div>
                                    <!-- Cliente / referencia -->
                                    <div class="form-group col-md-8">
                                        <label for="referencia">Cliente / Referencia</label>
                                        <input type="text" class="form-control fv-nombre" id="referencia" name="referencia" placeholder="Cliente o referencia del préstamo">
                                    </div>
                                </div>
                                <!-- /. form parametros -->
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info" id="prestamos-buscar">Buscar</button>
                            </div>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.card -->

                    <!-- Tabla de resultados -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- Tabla de datos -->
                                <div class="card-body table-responsive p-0" style="height:50vh; overflow: auto;" id="tabla-prestamos" name="tabla-prestamos">
                                    <!-- Aca viene la lista de préstamos -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- ************************************* -->
<!-- Ventanas modales para ediciones/confirmaciones -->
<!-- ************************************* -->

<!-- -------------------------------- -->
<!-- Edicion de un préstamo -->
<!-- -------------------------------- -->
<div class='modal' id='prestamo-edicion'>
    <?php
    // Esta vista se puede crear similar a cliente.modal.php
    // e incluirla aquí cuando exista, por ejemplo:
    // include "prestamo.modal.php";
    ?>
</div>
<!-- ----------------------------------- -->
<!-- /. Edicion de un préstamo -->
<!-- ----------------------------------- -->

<!-- ************************************* -->
<!-- ./Ventanas modales para ediciones/confirmaciones -->
<!-- ************************************* -->

<!-- Footer y Scripts -->
<?php include "piepagina.php" ?>

<!-- Scripts específicos de préstamos -->
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/prestamos.class.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>controllers/prestamos.controller.js"></script>

