<?php 
namespace App\Controllers;
use App\Models\ReparacionModel;
use App\Models\ClienteModel;
use App\Models\VehiculoModel;
use PdfReparaciones;
class Reparaciones extends BaseController
{
    protected $modelReparacione;

    protected $modelCliente;

    public function __construct()
    {
        $this->modelReparacion = new ReparacionModel();//creo objeto modelo
        $this ->modelCliente = new ClienteModel();
        $this ->modelVehiculo = new VehiculoModel();
    }
	public function index()
	{
        $data['clientes'] = $this->modelCliente->getData();
        $data['clienteId'] = isset($_GET['cliente']) ? $_GET['cliente'] : '';
        $data['vehiculos'] = !empty($data['clienteId']) ? $this->modelVehiculo->getVehiculosxCliente($data['clienteId']) : [];
        $data['titulo'] = '<center>Reparaciones</center>';
        $data['contenido'] = 'reparacion/index';
		return view('welcome_message', $data);
	}


public function listapdf($id){


    $pdf= new PdfReparaciones();
    $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
    $pdf->Addpage();
    $consulta2 = $this->model->getData($id);
    $consulta = $this->model->getDetalle($consulta2["r.id"]);
    foreach($consulta2 as $row){
    $html='
    <div style="text-align: center">
<h4>Reparacion No <span style="font-style: italic">'.$row["r.id"].'</span></h4>
';
    $html.='
<h4>Cliente <span style="font-style: italic">Manuel</span></h4>
<h4>Conductor <span style="font-style: italic">nombre</span></h4>
<h4>Direccion del cliente No <span style="font-style: italic">direccion</span></h4>
<h4>Telefono: <span style="font-style: italic">telefono</span></h4>
<h4>Email: <span style="font-style: italic"> email</span></h4>
</div>';
    }
    $html .='
    <table border="1">
        <thead>
            <tr style="background-color:#C8C6C6;color:#000000;">
                <th>ID</th>
                <th>DESCRIPCION</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
    <tbody>
    ';
    
    foreach($consulta as $row2){
        $html .='
        <tr>
            <td>' .$row2['id'].'</td>
            <td> algo </td>
            <td>' .$row2['valor'].'</td>
            <td>' .$row2['cantidad'].'</td>
            <td>' .$row2['valor'] * $row2['cantidad'].'</td>

        </tr>';
    }
    $html .='</tbody></table>';
    $pdf->writeHTML($html, true,false,true,false,'');
    $this->response->setHeader("Content-Type", "application/pdf");
    $pdf->Output('Listado_vehiculos.pdf', 'I');
    
}

}
