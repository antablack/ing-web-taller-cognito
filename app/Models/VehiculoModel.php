<?php
namespace App\Models;
use CodeIgniter\Model;

class vehiculoModel extends Model{
    protected $table = 'vehiculos'; // tabla en BD
    protected $allowedFields = ['id', 'placa', 'modelo','marca','capacidad', 'clientes_id', 'conductores_id', 'created','modified'];
    public function getData($id = null){
        if($id == null)
        {
            return $this->findAll();
        }
        return $this->where('id', $id)->first();
    }

    public function getVehiculosxCliente($id) {
    return $this->db->table("vehiculos as v")
            ->select("v.id, v.placa, v.modelo, v.marca, v.capacidad, v.clientes_id, CONCAT(ci.nombres, ' ', ci.apellidos) AS nombres_clientes, v.conductores_id, CONCAT(c.nombres, ' ', c.apellidos) AS nombres_conductor, v.created, v.modified")
            ->join('conductores AS c', 'v.conductores_id = c.id')
            ->join('clientes AS ci', 'v.clientes_id = ci.id')
            ->where('v.clientes_id', $id)
            ->get()->getResultArray();
    }

    public function eliminar($id){
        return $this->where('id', $id)->delete();
    }
    public function insertar($data){
        return $this->insert($data);
    }
    public function actualizar($id,$data){
        return $this->update($id,$data);
    }
}

