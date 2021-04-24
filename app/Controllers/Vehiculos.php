<?php 
namespace App\Controllers;
use App\Models\VehiculoModel;
use Pdf;
class Vehiculos extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new VehiculoModel();//creo objeto modelo
    }
	public function index()
	{
        $data['registros'] = $this->model->getData();
        $data['titulo'] = '<center>Listado de Vehículos</center>';
        $data['contenido'] = 'vehiculo/index';
		return view('welcome_message', $data);
	}

    public function eliminar($id){
        $this->model->eliminar($id);
        echo "Registro eliminado";
        return redirect()->to(site_url('vehiculos'));
    }
    //-----------------------------------------
    public function getByid($id){
        $data = $this->model->getData($id);
        echo json_encode($data);
    }

    public function guardar(){
        $data = [
            'placa' => $this->request->getVar('placa'),
            'modelo' => $this->request->getVar('modelo'),
            'marca' => $this->request->getVar('marca'),
            'capacidad' => $this->request->getVar('capacidad'),
            'clientes_id' => $this->request->getVar('cliente'),
            'conductores_id' => $this->request->getVar('conductor'),
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->model->insertar($data);

        $db = \Config\Database::connect();
        if ($db->affectedRows()>0) {
            echo "<div class='alert alert-success' role='alert'>
            <h4 class='alert-heading'>Correcto!</h4>
            <p>Registro guardado</p>
        </div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Error!</h4>
            <p>No se pudo guardar</p>
        </div>";
        }
    }

    public function actualizar(){
        $id = $this->request->getVar('idtext');
        $data = [
            'placa' => $this->request->getVar('placa'),
            'modelo' => $this->request->getVar('modelo'),
            'marca' => $this->request->getVar('marca'),
            'capacidad' => $this->request->getVar('capacidad'),
            'clientes_id' => $this->request->getVar('cliente'),
            'conductores_id' => $this->request->getVar('conductor'),
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->model->actualizar($id, $data);

        $db = \Config\Database::connect();
        if ($db->affectedRows()>0) {
            echo "<div class='alert alert-success' role='alert'>
            <h4 class='alert-heading'>Correcto!</h4>
            <p>Registro guardado</p>
        </div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Error!</h4>
            <p>No se pudo guardar</p>
        </div>";
        }
        
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

