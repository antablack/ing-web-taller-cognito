

<link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



<?php
$tit = 'Listado';
if (isset($titulo)) {
    $tit = $titulo;
}
?>


<h1><?php echo $tit; ?></h1>
    
    <center><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    <i class="fa fa-car"></i> Nuevo vehiculo</button></center>
<br>

<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>PLACA</th>
            <th>MODELO</th>
            <th>MARCA</th>
            <th>CAPACIDAD</th>
            <th>ACCIONES</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        foreach($registros as $row){
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['placa']; ?></td>
            <td><?php echo $row['modelo']; ?></td>
            <td><?php echo $row['marca']; ?></td>
            <td><?php echo $row['capacidad']; ?></td>
            <td>
                    <a href="<?php echo site_url('vehiculos/eliminar/' . $row['id']); ?>" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar?')">
                        <button type="button" class='btn btn-danger'>ELIMINAR
                        </button>
                    </a>
                    <a title="Editar">
                    <button type="button" class='btn btn-primary' onclick="OpenModal(<?php echo $row['id']; ?>);">EDITAR
                    </button>
                    </a>
                </td>
        </tr>

        <?php
        }
        ?>
    </tbody>

    <tfoot class="thead-dark">
        <tr>
            <th>ID</th>
            <th>PLACA</th>
            <th>MODELO</th>
            <th>MARCA</th>
            <th>CAPACIDAD</th>
            <th>ACCIONES</th>
        </tr>
    </tfoot>
</table>

<?php echo view('vehiculo/add'); ?>
<?php echo view('vehiculo/edit'); ?>
