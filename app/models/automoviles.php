<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Automoviles extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $marca = null;
    private $modelo = null;
    private $color = null;
    private $numeromotor = null;
    private $clase = null;
    private $detalle = null;
    private $placa = null;
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
    public function setMarca($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setModelo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->modelo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setColor($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->color = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setMotor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->numeromotor = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setClase($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->clase = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setDetalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->detalle = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setPlaca($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->placa = $value;
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

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getMotor()
    {
        return $this->numeromotor;
    }

    public function getClase()
    {
        return $this->clase;
    }

    public function getDetalle()
    {
        return $this->detalle;
    }

    public function getPlaca()
    {
        return $this->placa;
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
        $sql = 'SELECT id_automovil,marca,modelo,color, numero_motor, clase_auto, repuesto, placa, nombres_c
        FROM automovil INNER JOIN marca USING(id_marca) INNER JOIN modelo USING(id_modelo) INNER JOIN clase_automovil USING(id_clase_auto)
         INNER JOIN detalle_reparacion USING(id_detalle_rep) INNER JOIN clientes USING(id_cliente) 
                WHERE nombres_c ILIKE ? OR numero_motor ILIKE ? 
                ORDER BY nombres_c';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO automovil (id_marca, id_modelo, color, numero_motor, id_clase_auto, id_detalle_rep, placa, id_cliente)
                VALUES(?, ?, ?, ?, ?, ? , ?, ?)';
        $params = array($this->marca, $this->modelo, $this->color, $this->numeromotor, $this->clase, $this->detalle, $this->placa, $this->cliente);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT automovil.id_automovil,marca.marca,modelo,color, numero_motor, clase_auto, repuesto, placa, nombres_c, apellidos_c
                FROM automovil INNER JOIN marca USING(id_marca) INNER JOIN modelo USING(id_modelo) INNER JOIN clase_automovil USING(id_clase_auto)
                 INNER JOIN detalle_reparacion USING(id_detalle_rep) INNER JOIN clientes USING(id_cliente)  
                ORDER BY placa';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll2()
    {
        $sql = 'SELECT * FROM marca';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll3()
    {
        $sql = 'SELECT id_modelo, modelo, anio from modelo WHERE marca = ?';
        $params = array($this->marca);
        return Database::getRows($sql, $params);
    }
    public function readAll4()
    {
        $sql = 'SELECT * FROM clase_automovil';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll5()
    {
        $sql = 'SELECT * from clientes';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAll6()
    {
        $sql = 'SELECT id_detalle_rep, repuesto FROM detalle_reparacion';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT id_automovil, id_marca, id_modelo, color, numero_motor, id_clase_auto, id_detalle_rep, placa, id_cliente
                FROM automovil
                WHERE id_automovil = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    public function updateRow()
    {


        $sql = 'UPDATE automovil
                SET id_marca = ?, id_modelo = ?, color = ?, numero_motor = ?, id_clase_auto  = ?, id_detalle_rep = ?, placa = ?, id_cliente = ?
                WHERE id_automovil = ?';
        $params = array($this->marca, $this->modelo, $this->color, $this->numeromotor, $this->clase, $this->detalle, $this->placa, $this->cliente, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM automovil
                WHERE id_automovil = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readAutomovilRpt()
    {
        $sql = 'SELECT id_automovil,marca.marca,modelo,color, numero_motor, clase_auto, repuesto, placa, nombres_c
        FROM automovil INNER JOIN marca USING(id_marca) INNER JOIN modelo USING(id_modelo) INNER JOIN clase_automovil USING(id_clase_auto)
         INNER JOIN detalle_reparacion USING(id_detalle_rep) INNER JOIN clientes USING(id_cliente)
         WHERE id_automovil = ?
        ORDER BY marca';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function clientesConMasAutomovil()
    {
        $sql = 'SELECT nombres_c, count(id_automovil) cantidad from automovil INNER JOIN clientes USING(id_cliente) group by nombres_c order by nombres_c desc limit 10';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
