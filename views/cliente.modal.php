<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title bg-light" id="titulo">Cliente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body container">
            <form>
                <!-- Input para guardar el ID del movimiento al Editar -->
                <input type="hidden" name="id" id="id" value="">

                <!-- Nombre y apellido -->
                <div class="row">
                    <!-- Nombre -->
                    <div class="form-group  col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control fv-novacio" id="nombre" name="nombre" placeholder="nombre">
                    </div>
                    <!-- Apellido -->
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control fv-novacio" id="apellido" name="apellido" placeholder="apellido">
                    </div>
                </div>

                <!-- Correo -->
                <div class="row">
                    <!-- Correo Principal -->
                    <div class="form-group  col-md-6">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control fv-novacio" id="correo" name="correo" placeholder="casilla@correo.com">
                    </div>
                    <!-- Correo Secundario -->
                    <div class="form-group  col-md-6">
                        <label for="correo2">Correo Alternativo</label>
                        <input type="email" class="form-control fv-novacio" id="correo2" name="correo2" placeholder="casilla@correo.com">
                    </div>
                </div>

                <!-- Tipo y Nro de documentos y Cuit / Cuil-->
                <div class="row">
                    <!-- Tipo de documento -->
                    <div class="form-group col-md-4">
                        <label>Tipo Documento</label>
                        <select class="form-control" name="tipodoc" id="tipodoc">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="nrodocum">Numero Documento</label>
                        <input type="text" class="form-control fv-novacio" id="nrodocum" name="nrodocum" placeholder="12345678">
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="cuit-cuil">CUIT / CUIL</label>
                        <input type="text" class="form-control fv-novacio" id="cuit-cuil" name="cuit-cuil" placeholder="99-12345678-9" pattern="[0-9-]{13}">
                    </div>
                </div>

                <!-- Tipo de Iva e IIBB-->
                <div class="row">
                    <!-- Tipo de Iva -->
                    <div class="form-group col-md-4">
                        <label>Tipo IVA</label>
                        <select class="form-control" name="tipoiva" id="tipoiva">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tipo IIBB</label>
                        <select class="form-control" name="tipoiibb" id="tipoiibb">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="iibb-nro">Numero IIBB</label>
                        <input type="text" class="form-control fv-novacio" id="iibb-nro" name="iibb-nro" placeholder="">
                    </div>
                </div>

                <!-- Separador de datos minimos de los de domicilio -->
                <hr class="my-4" style="border-top: 2px solid #95b1d0;">

                <!-- Domicilio particular -->
                <div class="row">
                    <!-- Calle -->
                    <div class="form-group  col-md-6">
                        <label for="calle">Calle</label>
                        <input type="text" class="form-control fv-novacio" id="calle" name="calle" placeholder="calle">
                    </div>
                    <!-- Nro -->
                    <div class="form-group col-md-2">
                        <label for="localidad">Numero</label>
                        <input type="text" class="form-control fv-novacio" id="callenro" name="callenro" placeholder="numero">
                    </div>
                    <!-- Piso -->
                    <div class="form-group col-md-2">
                        <label for="callepiso">Piso</label>
                        <input type="text" class="form-control fv-novacio" id="callepiso" name="callepiso" placeholder="Piso">
                    </div>
                    <!-- Depto -->
                    <div class="form-group col-md-2">
                        <label for="calledepto">Depto</label>
                        <input type="text" class="form-control fv-novacio" id="calledepto" name="calledepto" placeholder="Depto">
                    </div>
                </div>

                <!-- Localidad y Provincia -->
                <div class="row">
                    <!-- CodPostal -->
                    <div class="form-group  col-md-3">
                        <label for="codpostal">Cod.Postal</label>
                        <input type="text" class="form-control fv-novacio" id="codpostal" name="codpostal" placeholder="codpostal">
                    </div>
                    <!-- Localidad -->
                    <div class="form-group col-md-5">
                        <label>Localidad</label>
                        <select class="form-control" name="localidad" id="localidad">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <!-- Provincia -->
                    <div class="form-group col-md-4">
                        <label>Provincia</label>
                        <select class="form-control" name="provincia" id="provincia">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                </div>

                <!-- Telefonos -->
                <div class="row">
                    <!-- Particular -->
                    <div class="form-group  col-md-3">
                        <label for="telparticular">Tel.Particular</label>
                        <input type="tel" class="form-control fv-novacio" id="telparticular" name="telparticular" placeholder="+54 11 1234-5678" pattern="[0-9]{4}-[0-9]{4}">
                    </div>
                    <!-- Particular 2-->
                    <div class="form-group  col-md-3">
                        <label for="telparticular2">Tel.Particular 2</label>
                        <input type="tel" class="form-control fv-novacio" id="telparticular2" name="telparticular2" placeholder="+54 11 1234-5678" pattern="[0-9]{4}-[0-9]{4}">
                    </div>
                    <!-- Referente -->
                    <div class="form-group  col-md-3">
                        <label for="telreferente">Tel.Referente</label>
                        <input type="tel" class="form-control fv-novacio" id="telreferente" name="telreferente" placeholder="+54 11 1234-5678" pattern="[0-9]{4}-[0-9]{4}">
                    </div>
                    <!-- Celular -->
                    <div class="form-group  col-md-3">
                        <label for="telcelular">Tel.Celular</label>
                        <input type="tel" class="form-control fv-novacio" id="telcelular" name="telcelular" placeholder="+54 11 1234-5678" pattern="[0-9]{4}-[0-9]{4}">
                    </div>
                </div>

                <!-- Fecha Nacimiento, Sexo Estado Civil-->
                <div class="row">
                    <!-- Fecha Nacimiento -->
                    <div class="form-group  col-md-3">
                        <label for="fecnacim">Fecha Nacimiento</label>
                        <input type="date" class="form-control fv-novacio" id="fecnacim" name="fecnacim" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Sexo</label>
                        <select class="form-control" name="sexo" id="sexo">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Estado Civil</label>
                        <select class="form-control" name="estcivil" id="estcivil">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                </div>

                <!-- Separador -->
                <hr class="my-4" style="border-top: 2px solid #95b1d0;">

                <!-- Conyuge-->
                <div class="row">
                    <!-- Conyuge-->
                    <div class="form-group  col-md-12">
                        <label for="conyuge">Conyuge</label>
                        <input type="text" class="form-control" id="conyuge" name="conyuge" placeholder="(conyuge)">
                    </div>
                </div>

                <!-- Conyuge - Tipo y Nro de documentos y Cuit / Cuil-->
                <div class="row">
                    <!-- Tipo de documento -->
                    <div class="form-group col-md-4">
                        <label>Tipo Documento</label>
                        <select class="form-control" name="cony-tipodoc" id="cony-tipodoc">
                            <!-- <?php echo $listacuentas; ?> -->
                        </select>
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="cony-nrodocum">Numero Documento</label>
                        <input type="text" class="form-control fv-novacio" id="cony-nrodocum" name="cony-nrodocum" placeholder="12345678">
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="cuit-cuil">CUIT / CUIL</label>
                        <input type="text" class="form-control fv-novacio" id="cony-cuit-cuil" name="cony-cuit-cuil" placeholder="99-12345678-9" pattern="[0-9-]{13}">
                    </div>
                </div>

                <div class="row">
                    <!-- Fecha Alta -->
                    <div class="form-group  col-md-3">
                        <label for="fecalta">Fecha de Alta</label>
                        <input type="date" class="form-control fv-novacio" id="fecalta" name="fecalta" placeholder="">
                    </div>
                </div>

        </div>

        </form>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_confirmar">Confirmar</button>
    </div>
</div>
</div>