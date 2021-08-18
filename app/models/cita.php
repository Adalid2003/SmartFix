<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Cita extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $fecha = null;
    private $hora = null;
    private $estado = null;
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
    public function setHora($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->hora = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
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

    public function getHora()
    {
        return $this->hora;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getEstado()
    {
        return $this->estado;
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
        $sql = 'SELECT id_cita,fecha_cita,nombres_c,estado_cita, hora
        FROM cita INNER JOIN clientes USING(id_cliente) INNER JOIN estado_cita USING(id_estado_cita) INNER JOIN hora_cita USING(id_hora)
                WHERE nombres_c ILIKE ? OR fecha_cita ILIKE ? 
                ORDER BY fecha_cita';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO cita (fecha_cita, id_cliente, id_estado_cita, id_hora)
                VALUES(?, ?, ?, ?)';
        $params = array($this->fecha, $_SESSION['id_cliente'], $this->estado, $this->hora);
        return Database::executeRow($sql, $params);
    }
    public function createRowP()
    {
        $sql = 'INSERT INTO cita (fecha_cita, id_cliente, id_estado_cita, id_hora)
                VALUES(?, ?, ?, ?)';
        $params = array($this->fecha, $this->cliente, $this->estado, $this->hora);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_cita,fecha_cita,nombres_c,estado_cita, hora
                FROM cita INNER JOIN clientes USING(id_cliente) INNER JOIN estado_cita USING(id_estado_cita) INNER JOIN hora_cita USING(id_hora)
                ORDER BY fecha_cita';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllP()
    {
        $sql = 'SELECT id_cita,fecha_cita,nombres_c,estado_cita, hora
                FROM cita INNER JOIN clientes USING(id_cliente) INNER JOIN estado_cita USING(id_estado_cita) INNER JOIN hora_cita USING(id_hora)
                WHERE id_cliente = ?
                ORDER BY fecha_cita';
        $params = array($this->$_SESSION['id_cliente']);
        return Database::getRows($sql, $params);
    }
    public function readAll2()
    {
        $sql = 'SELECT * FROM hora_cita';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll3()
    {
        $sql = 'SELECT * from estado_cita';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll4()
    {
        $sql = 'SELECT * FROM clientes';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT id_cita, fecha_cita, id_cliente, id_estado_cita, id_hora
                FROM cita
                WHERE id_cita = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    public function updateRow()
    {


        $sql = 'UPDATE cita
                SET fecha_cita = ?, id_hora = ?, id_estado_cita = ?, id_cliente = ?
                WHERE id_cita = ?';
        $params = array($this->fecha, $this->hora, $this->estado, $this->cliente, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM cita
                WHERE id_cita = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
