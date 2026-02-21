<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Reservas</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body container">
            <form>
                <!-- Input para guardar el ID del movimiento al Editar -->
                <input type="hidden" name="id" id="id" value="">

                <!-- Fecha / Importe / Tipo -->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control fv-fecha" name="fecha" id="fecha" placeholder="Fecha" value="" required>
                    </div>

                    <!-- Importe -->
                    <div class="form-group col-md-4">
                        <label for="importe" class="form-label">Importe</label>
                        <input type="numeric" class="form-control fv-importe" name="importe" id="importe" placeholder="Importe" value="">
                    </div>

                    <!-- Tipo -->
                    <div class="form-group col-md-5">
                        <label class="col-6 form-label">Tipo</label>
                        <select class="form-control fv-select" name="tipo" id="tipos">
                        </select>
                    </div>
                </div>

                <!-- Cliente -->
                <div class="form-group">
                    <label class="col-12">Cliente/Proveedor
                        <select class="form-control fv-select" name="cliente" id="clientes">
                        </select>
                    </label>
                </div>

                <!-- Concepto -->
                <div class="form-group">
                    <label for="Concepto">Concepto</label>
                    <input type="text" class="form-control fv-novacio" id="concepto" name="concepto" placeholder="Concepto">
                </div>

                <!-- Lista de cuentas -->
                <div class="form-row">
                    <!-- Pedir una cuenta e importe para agregar a la lista-->
                    <!-- Cuuenta -->
                    <div class="form-group col-md-6">
                        <label for="cuentas-lista" class="form-label">Selecciona una cuenta</label>
                        <select class="form-control fv-novacio" name="cuentas-lista" id="cuentas-lista"></select>
                    </div>
                    <!-- Importe -->
                    <div class="form-group col-md-4">
                        <label for="cuentas-importe" class="form-label">Importe</label>
                        <input type="numeric" class="form-control" name="cuentas-importe" id="cuentas-importe" placeholder="Importe" value="">
                    </div>
                    <!--Boton de agregar-->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" id="cuentas-add">Agregar</button>
                    </div>
                </div>

                <!-- Lista de cuentas -->
                <div class="form-group" style="height:100px">
                    <div id="div-cuentas-tabla" name="cuentas-tabla">
                        <table class="table table-striped table-head-fixed  table-borderless  table-sm" id="cuentas-tabla">
                            <thead>
                                <tr>
                                    <!-- <th class="col-1" style=" visibility: hidden">ID</th> -->
                                    <th class="col-7">Cuenta</th>
                                    <th class="col-4">Importe</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Ya esta confirmada -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="confirmada">
                    <label class="form-check-label" for="confirmada">Esta confirmada</label>
                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar">Cerrar</button>
            <button type="button" class="btn btn-primary" id="grabar">Confirmar</button>
        </div>
    </div>
</div>