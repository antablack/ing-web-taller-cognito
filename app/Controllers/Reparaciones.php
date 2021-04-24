<?php 
namespace App\Controllers;
use App\Models\ReparacionModel;
use App\Models\ClienteModel;
use App\Models\VehiculoModel;

use Pdf;
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


public function listapdf(){
    $pdf= new Pdf();
    $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
    $pdf->Addpage();
    $regvehiculos = $this->model->getData();
    $html='
    <table border="1">
        <thead>
            <tr style="background-color:#C8C6C6;color:#000000;">
                <th>PLACA</th>
                <th>MODELO</th>
                <th>MARCA</th>
                <th>CAPACIDAD</th>
            </tr>
        </thead>
    <tbody>
    ';
    foreach($regvehiculos as $row){
        $html .='
        <tr>
            <td>' .$row["placa"].'</td>
            <td>' .$row["modelo"].'</td>
            <td>' .$row["marca"].'</td>
            <td>' .$row["capacidad"].'</td>
        </tr>';
    }
    $html .='</tbody></table>';
    $pdf->writeHTML($html, true,false,true,false,'');
    $this->response->setHeader("Content-Type", "application/pdf");
    $pdf->Output('Listado_vehiculos.pdf', 'I');
    
}

}

