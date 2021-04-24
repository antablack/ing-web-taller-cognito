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

