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
            $this->Direccion_proveedor = $value;
            return true;
        } else {
            return false;
        }
    }
    
        // Se verifica que el número tenga el formato 0000-0000 y que inicie con 2, 6 o 7.
        public function setTelefono_proveedor($value)
    {
        if ($this->validatePhone($value)) {
            $this->Telefono_proveedor = $value;
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

    public function getNombre_proveedor()
    {
        return $this->Nombre_proveedor;
    }

    public function getTelefono_proveedor()
    {
        return $this->Telefono_proveedor;
    }

    public function getDireccion_proveedor()
    {
        return $this->Direccion_proveedor;
    }

     /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_proveedor,nombre_proveedor,telefono_prov,direccion_prov
                FROM proveedores
                WHERE nombre_proveeedor ILIKE ? 
                ORDER BY nombre_proveedor';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO proveedores(nombre_proveedor, telefono_prov, direccion_prov)
                VALUES(?, ?, ?)';
        $params = array($this->Nombre_proveedor, $this->Telefono_proveedor, $this->Direccion_proveedor);
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