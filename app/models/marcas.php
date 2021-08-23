<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Marcas extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $marca = null;

    /*
    *   Métodos para validar y asignar valores de los atributos.
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
        if ($this->validateAlphabetic($value, 1, 50)) {
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

    public function getMarca()
    {
        return $this->marca;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_marca, marca
                FROM marca
                WHERE marca ILIKE ?
                ORDER BY marca';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'SELECT max(id_marca)+1 mas from marca';
        $params = null;
        if ($data = Database::getRow($sql, $params)){
            $sql = 'INSERT INTO marca (id_marca, marca)
                VALUES(?, ?)';
                $params = array($data['mas'], $this->marca);
                return Database::executeRow($sql, $params);
        } else {
            return false;
        }
        
    }

    public function readAll()
    {
        $sql = 'SELECT id_marca, marca
        FROM marca
        ORDER BY marca';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_marca, marca
                FROM marca
                WHERE id_marca = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE marca 
                SET marca = ?
                WHERE id_marca = ?';
        $params = array($this->marca, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM marca
                WHERE id_marca = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}