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
        $this->modelReparacione = new ReparacionModel();//creo objeto modelo
        $this ->modelCliente = new ClienteModel();
        $this ->modelVehiculo = new VehiculoModel();
    }
	public function index()
	{
        $data['clientes'] = $this->modelCliente->getData();
        $data['clienteId'] = isset($_GET['cliente']) ? $_GET['cliente'] : '';
        $data['vehiculos'] = !empty($data['clienteId']) ? $this->modelVehiculo->getVehiculosxCliente() : [];
        $data['titulo'] = '<center>Listado de Vehículos</center>';
        $data['contenido'] = 'reparacion/index';
		return view('welcome_message', $data);
	}


public function listapdf(){

    $db      = \Config\Database::connect();
    //vehiculos
    $builder = $db->table('vehiculos');
    $query = $builder->getWhere(['id' => '72']);
    //reparacion
    $builder = $db->table('reparaciones');
    $query = $builder->getWhere(['id' => '72']);
    $builder = $db->table('clientes');
    $query = $builder->getWhere(['id' => '72']);
    $pdf= new PdfReparaciones();
    $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
    $pdf->Addpage();
    // $regvehiculos = $this->model->getData();
    foreach($query->getResult() as $row){
    $html='
    <div style="text-align: center">
<h4>Reparacion No <span style="font-style: italic">'.$row.'</span></h4>
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
                <th>OBSERVACION</th>
                <th>VALOR</th>
                <th>FECHA</th>
            </tr>
        </thead>
    <tbody>
    ';
    foreach($query->getResult() as $row){
        $html .='
        <tr>
            <td>' .$row->id.'</td>
            <td>' .$row->observacion.'</td>
            <td>' .$row->valor.'</td>
            <td>' .$row->fecha.'</td>

        </tr>';
    }
    $html .='</tbody></table>';
    $pdf->writeHTML($html, true,false,true,false,'');
    $this->response->setHeader("Content-Type", "application/pdf");
    $pdf->Output('Listado_vehiculos.pdf', 'I');
    
}

}
