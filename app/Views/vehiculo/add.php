<?php 
use App\Models\ClienteModel;
use App\Models\ConductorModel;
$ModelCliente= new ClienteModel();
$ModelConductor= new ConductorModel();
?>

<div class="modal fade" id="modalForm">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4> Registrar nuevo vehiculo </h4>
                <button type="button" class="close" data-dismiss="modal" onclick="cerrar();">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>

            </div>
            <!-- Modal Body -->
            <form method="post" name="formnew" id="formnew">
                <div class="modal-body">
                    <p class="statusMsg">
                    <div id="resultados"> </div>
                    </p>
                    <div class="form-group">
                        <label>Placa:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="placa" placeholder="Ingrese placa" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Modelo:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="modelo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Marca:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="marca" placeholder="Marca" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Capacidad:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="capacidad" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cliente:</label>
                        <div class="input-group">
                            <select class="form-control" name="cliente" aria-label="Default select example">
                                <option selected>Seleccione un cliente</option>
                                <?php 
                                $clientes = $ModelCliente->getData();
                                foreach($clientes as $row){
                                    echo '<option value="'. $row['id'].'">'.$row['nombres'].' '.$row['apellidos'].'</option>';
                                }
                                ?>
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Conductor:</label>
                        <div class="input-group">
                        <select class="form-control" name="conductor" aria-label=".form-select-lg example">
                                <option selected>Seleccione un conductor</option>
                                <?php 
                                $conductores = $ModelConductor->getData();
                                foreach($conductores as $row){
                                    echo '<option value="'. $row['id'].'">'.$row['nombres'].' '.$row['apellidos'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div class='col-md-6'>
                        <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                    </div>
                    <div class='col-md-4'>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cerrar();">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END  Fomrulario Add    -->
<script type="text/javascript">
    function removeMessage() {
        setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                //$(this).remove();
                $(".alert").alert('close');
            });
        }, 5000);
    }


    function limpiar() {
        $('#formnew').find('input:text, input:password, input:file, select, textarea').val('');
        $('#correo').val('');
    }

    function cerrar() {
        location.reload();
    }

    $('#formnew').submit(function(event) {
        var parametros = $('#formnew').serialize(); //obtiene todos los campos con sus datos
        console.log(parametros);
        var salida = "";
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('vehiculos/guardar')?>",
            data: parametros,
            beforeSend: function() {
                $('#resultados').show();
            },
            error: function() {
                $('#resultados').html(salida);
            },
            success: function(datos) {
                $('#resultados').html(datos);
                limpiar();
                removeMessage();

            }
        });
        event.preventDefault();

    })
</script>