<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Modelos extends Validator
{
     // Declaración de atributos (propiedades).
     private $id = null;
     private $modelo = null;
     private $anio = null;
     private $marca = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setModelo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->modelo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAnio($value)
    {
        if ($this->validateNaturalNumber($value, 1, 50)) {
            $this->anio = $value;
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

     /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function getMarca()
    {
        return $this->marca;
    }
    
     /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_modelo,modelo,anio,marca
                FROM modelo INNER JOIN marca USING(id_marca)
                WHERE modelo ILIKE ? OR marca ILIKE ? 
                ORDER BY marca';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'SELECT max(id_modelo)+1 mas from modelo';
        $params = null;
        if ($data = Database::getRow($sql, $params)){
            $sql = 'INSERT INTO modelo (id_modelo, modelo, anio, marca)
                VALUES(?, ?, ?, ?)';
                $params = array($data['mas'], $this->modelo, $this->anio, this->marca);
                return Database::executeRow($sql, $params);
        } else {
            return false;
        }
        
    }

    public function readAll()
    {
        $sql = 'SELECT id_modelo, modelo, anio, marca
        FROM modelo
        ORDER BY marca';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAllMar()
    {
        $sql = 'SELECT id_marca, marca from marca';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readOne()
    {
        $sql = 'SELECT id_modelo, modelo, anio, marca
                FROM modelo
                WHERE id_modelo = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE modelo 
                SET modelo = ?, anio = ?, marca = ?
                WHERE id_modelo = ?';
        $params = array($this->modelo, $this->anio, $this->marca, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM modelo
                WHERE id_modelo = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}