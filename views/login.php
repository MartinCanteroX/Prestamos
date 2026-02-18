<!-- Encabezados -->
<?php include "encabezado.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <div class="container-fluid">
        </div>
    </section> -->

    <!-- Main content -->
    <section class="content">
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div> -->
    </section>
</div>

<!-- -------------------------------- -->
<!-- Solicitar usuario y clave        -->
<!-- -------------------------------- -->
<div class='modal' id='loginModal'>
    <?php include "login-modal.php" ?>
</div>

<!-- Footer y Scripts -->
<?php include "piepagina.php" ?>

<script type="text/javascript" src="<?php echo BASE_URL_JS ?>controllers/login.controller.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>clases/login.class.js"></script>