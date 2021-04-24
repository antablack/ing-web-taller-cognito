<?php
namespace App\Models;
use CodeIgniter\Model;

class ReparacionModel extends Model{
    protected $table = 'vehiculos'; // tabla en BD
    protected $allowedFields = ['id', 'placa', 'modelo','marca','capacidad', 'clientes_id', 'conductores_id', 'created','modified'];

    public function getData($vehiculoId){
        return $this->db->table("reparaciones AS r")
        ->select("r.id, r.fecha, CONCAT(cli.nombres, ' ', cli.apellidos) AS nombre_cliente, CONCAT(c.nombres, ' ', c.apellidos) AS nombre_conductor, cli.direccion, cli.telefono, cli.correo")
        ->join('vehiculos as v', 'v.id = r.vehiculos_id')
        ->join('clientes AS cLi', 'cli.id = v.clientes_id')
        ->join('conductores as c', 'c.id = v.conductores_id')
        ->where('r.vehiculos_id', $vehiculoId)
        ->get()->getResultArray();
    }

    public function getDetalle($reparacionId){
        return $this->db->table("detalles as d")
        ->select("d.id, s.descripcion, s.precio, d.cantidad, d.costo")
        ->join('clientes AS cLi', 'd.servicios_id = s.id ')
        ->where('d.reparaciones_id', $reparacionId)
        ->get()->getResultArray();
    }
}

