<link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
<!-- Custom styles for this template -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



<?php
$tit = 'Listado';
if (isset($titulo)) {
    $tit = $titulo;
}

$clientes = isset($clientes) ? $clientes : [];
$clienteId = isset($_GET['cliente']) ? $_GET['cliente'] : '';

?>


<h1>
    <?php echo $tit; ?>
</h1>

<center>
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
        <i class="fa fa-car"></i> Nuevo vehiculo
    </button>
</center>
<br>

<form method="GET">
    <label for="cliente" class="form-label">Cliente</label>

    <select class="form-control" id="cliente" name="cliente">
        <option <?php echo $clienteId == "" ? "selected" : "" ?> value=""></option>

        <?php 
            
            foreach ($clientes as $cliente) {
                echo "<option value=".$cliente['id']." ". ($cliente['id']== $clienteId ? "selected" : "") ." >".$cliente['nombres']." ".$cliente['apellidos']."</option>";
            }
        ?>
    </select>
    <input class="btn btn-primary mt-2" type="submit" value="Filtrar"/>
</form>