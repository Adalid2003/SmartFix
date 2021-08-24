<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Reparacion extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $auto = null;
    private $repuesto = null;
    private $estado = null;
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
    public function setCita($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->auto = $value;
            return true;
        } else {
            return false;
        }
    }
    
    
    public function setEstado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setObra($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->obra = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setRepuesto($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->repuesto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }
    


    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getAuto()
    {
        return $this->auto;
    }

    public function getRepuesto()
    {
        return $this->repuesto;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
    
    public function getObra()
    {
        return $this->obra;
    }  

    public function getCliente()
    {
        return $this->cliente;
    }  

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_detalle_rep, fecha_cita, estado_reparacion, nombres_u, repuesto, precio_repuesto, mano_obra
        FROM detalle_reparacion INNER JOIN cita USING(id_cita) INNER JOIN estado_reparacion USING(id_estado_rep) INNER JOIN usuarios USING(id_usuario)
                WHERE estado_reparacion ILIKE ? OR fecha_cita ILIKE ? 
                ORDER BY estado_reparacion';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO detalle_reparacion (id_automovil, id_estado_rep, id_usuario, repuesto, precio_repuesto, mano_obra)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->auto, $this-> estado, $_SESSION['id_usuario'], $this->repuesto, $this->precio, $this->obra);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT detalle_reparacion.id_detalle_rep,placa, estado_reparacion, nombres_u, repuesto, precio_repuesto, mano_obra
        FROM detalle_reparacion INNER JOIN estado_reparacion USING(id_estado_rep) INNER JOIN usuarios USING(id_usuario) INNER JOIN automovil USING(id_automovil)  
        ORDER BY estado_reparacion';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll2()
    {
        $sql = 'SELECT automovil.id_automovil, placa
        FROM automovil INNER JOIN marca USING(id_marca) INNER JOIN modelo USING(id_modelo) INNER JOIN clase_automovil USING(id_clase_auto)
        INNER JOIN clientes USING(id_cliente)  
        ORDER BY placa';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll3()
    {
        $sql = 'SELECT * from estado_reparacion';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAll4()
    {
        $sql = 'SELECT id_automovil, id_marca, id_modelo, color, numero_motor, id_clase_auto, id_detalle_rep, placa, id_cliente from automovil where id_cliente = ?';
        $params = array($this->cliente);
        return Database::getRows($sql, $params);
    }


    public function readOne()
    {
        $sql = 'SELECT id_detalle_rep, id_automovil, id_estado_rep, id_usuario, repuesto, precio_repuesto, mano_obra
                FROM detalle_reparacion
                WHERE id_detalle_rep = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    public function updateRow()
    {


        $sql = 'UPDATE detalle_reparacion
                SET id_cita = ?, id_estado_rep = ?, repuesto = ?, precio_repuesto = ?, mano_obra = ?
                WHERE id_detalle_rep = ?';
        $params = array($this->cita, $this->estado, $this->repuesto, $this->precio, $this->obra, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM detalle_reparacion
                WHERE id_detalle_rep = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function factura()
    {
        $sql = 'SELECT detalle_reparacion.id_detalle_rep, placa,repuesto, precio_repuesto, mano_obra, estado_reparacion, SUM(precio_repuesto+mano_obra) suma from detalle_reparacion INNER JOIN automovil USING(id_automovil) INNER JOIN estado_reparacion USING(id_estado_rep)
        where detalle_reparacion.id_detalle_rep = ?
        group by placa,repuesto, precio_repuesto, mano_obra, detalle_reparacion.id_detalle_rep, estado_reparacion';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}
