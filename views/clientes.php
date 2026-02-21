<!-- Encabezados -->
<?php include "encabezado.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item active"><a href="<?php echo BASE_URL ?>clientes/nuevo">Nuevo</a></li>
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
                            <h3 class="card-title">Clientes</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form parametros de buqueda start -->
                        <form id="form-clientes">
                            <div class="card-body pb-1">
                                <!-- Fecha Alta desde, hasta y nombre  -->
                                <div class="row">
                                    <!-- Desde -->
                                    <div class="form-group col-md-2">
                                        <label for="desde">de Fecha</label>
                                        <input type="date" class="form-control fv-fecha" name="desde" id="desde" placeholder="Desde" >
                                    </div>
                                    <!-- Hasta -->
                                    <div class="form-group col-md-2">
                                        <label for="hasta">a Fecha</label>
                                        <input type="date" class="form-control fv-fecha" name="fecha" id="hasta" placeholder="Hasta" >
                                    </div>
                                    <!-- Nombre o parte -->
                                    <div class="form-group col-md-8">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control fv-nombre" id="nombre" name="nombre" placeholder="Nombre" >
                                    </div>
                                </div>
                                <!-- /. form paramtros -->
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info" id="buscar">Buscar</button>
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
                                <div class="card-body table-responsive p-0" style="height:50vh; overflow: auto;" id="tabla-clientes" name="tabla-clientes">
                                    <!-- Aca vienen la lista vencimientos   -->
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
<!-- Edicion rapida de un vencimiento -->
<!-- -------------------------------- -->
<!--
<div class='modal' id='vencimientos-edicion-simple'>
    <?php include "vencimiento-modal.php" ?>
</div>
-->
<!-- ----------------------------------- -->
<!-- /. Edicion rapida de un vencimiento -->
<!-- ----------------------------------- -->

<!-- ************************************* -->
<!-- ./Ventanas modales para ediciones/confirmaciones -->
<!-- ************************************* -->

<!-- Footer y Scripts -->
<?php include "piepagina.php" ?>

<!-- Validaciones del formulario -->
<!-- 
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/cuentas.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/movimiento.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/egreso.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/ingreso.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/movimientos.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/transferencia.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/vencimiento.class.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/vencimientos.class.js"></script>
    -->
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/clientes.class.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>controllers/clientes.controller.js"></script>