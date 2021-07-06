<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Reparacion extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $detallle_rep = null;
    private $cita = null;
    private $estado = null;
    private $repuesto = null;
    private $id_usuario = null;
    private $precio = null;
    private $obra = null;
    private $cliente = null;

     /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setDetalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->detalle_rep = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCita($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cita = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->id_usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setObra($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->obra = $value;
            return true;
        } else {
            return false;
        }
    }
    
    
        public function setRepuesto($value)
    {
        if ($this->repuesto($value)) {
            $this->Telefono_proveedor = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }
    
    
    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getid()
    {
        return $this->id;
    }

    public function getdetalle_repr()
    {
        return $this->detalle_rep;
    }

    public function getcita()
    {
        return $this->cita;
    }

    public function getestado()
    {
        return $this->estado;
    }

    public function getrepuesto()
    {
        return $this->repuesto;
    }

    public function getid_usuario()
    {
        return $this->id_usuario;
    }

    public function getprecio()
    {
        return $this->precio;
    }

    public function getobra()
    {
        return $this->obra;
    }
    public function getcliente()
    {
        return $this->cliente;
    }
     /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_detalle, detalle_rep, id_cita, estado_rep, id_usuario, repuesto, precio_repuesto, mano_obra
                FROM detalle_reparacion 
                WHERE detalle_rep ILIKE ? 
                ORDER BY detalle_rep';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO detalle_reparacion(detalle_rep, id_cita, estado_rep)
                VALUES(?, ?, ?)';
        $params = array($this->detalle_rep, $this->id_cita, $this->Direccion_proveedor);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_automovil,marca,modelo,color, numero_motor, clase_auto, repuesto, placa, nombres_c
                FROM automovil INNER JOIN marca USING(id_marca) INNER JOIN modelo USING(id_modelo) INNER JOIN clase_automovil USING(id_clase_auto)
                 INNER JOIN detalle_reparacion USING(id_detalle_rep) INNER JOIN clientes USING(id_cliente)  
                ORDER BY placa';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll2()
    {
        $sql = 'SELECT id_marca, marca from marca';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll3()
    {
        $sql = 'SELECT id_modelo, modelo, anio from modelo';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT nombre_proveedor, telefono_prov,direccion_prov
                FROM proveedores
                WHERE id_proveedor = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    public function updateRow()
    {
        

        $sql = 'UPDATE proveedores
                SET nombre_proveedor = ?, telefono_prov = ?, direccion_prov = ?
                WHERE id_proveedor = ?';
        $params = array($this->Nombre_proveedor, $this->Telefono_proveedor, $this->Direccion_proveedor);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM proveedores
                WHERE id_proveedores = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}