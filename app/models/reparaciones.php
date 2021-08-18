<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Reparacion extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $cita = null;
    private $repuesto = null;
    private $estado = null;
    private $precio = null;
    private $obra = null;

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
            $this->cita = $value;
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
    


    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getCita()
    {
        return $this->cita;
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
        $sql = 'INSERT INTO detalle_reparacion (id_cita, id_estado_rep, id_usuario, repuesto, precio_repuesto, mano_obra)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->cita, $this-> estado, $_SESSION['id_usuario'], $this->repuesto, $this->precio, $this->obra);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_detalle_rep, fecha_cita, estado_reparacion, nombres_u, repuesto, precio_repuesto, mano_obra
                FROM detalle_reparacion INNER JOIN cita USING(id_cita) INNER JOIN estado_reparacion USING(id_estado_rep) INNER JOIN usuarios USING(id_usuario)
                ORDER BY estado_reparacion';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll2()
    {
        $sql = 'SELECT * FROM cita';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll3()
    {
        $sql = 'SELECT * from estado_reparacion';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT id_detalle_rep, id_cita, id_estado_rep, id_usuario, repuesto, precio_repuesto, mano_obra
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
}
