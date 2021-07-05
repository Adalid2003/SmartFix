<?php
/*
*	Clase para manejar la tabla clientes de la base de datos. Es clase hija de Validator.
*/
class Clientes extends Validator
{
    //Declaraciones de atributos (propiedades)
    private $idc = null;
    private $nombresc = null;
    private $apellidosc = null;
    private $duic = null;
    private $emailc = null;
    private $aliasc = null;
    private $clavec = null;
    private $telefonoc = null;
    private $nacimientoc = null;

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombresc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidosc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui($value)
    {
        if ($this->validateDUI($value)) {
            $this->duic = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEmail($value)
    {
        if ($this->validateEmail($value)) {
            $this->emailc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->aliasc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPassword($value)
    {
        if ($this->validatePassword($value)) {
            $this->clavec = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefonoc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNacimineto($value)
    {
        if ($this->validateDate($value)) {
            $this->nacimientoc = $value;
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
        return $this->idc;
    }

    public function getNombres()
    {
        return $this->nombresc;
    }

    public function getApellidos()
    {
        return $this->apellidosc;
    }

    public function getDUI()
    {
        return $this->duic;
    }

    public function getCorreo()
    {
        return $this->emailc;
    }

    public function getAlias()
    {
        return $this->aliasc;
    }

    public function getClave()
    {
        return $this->clavec;
    }

    public function getTelefono()
    {
        return $this->telefonoc;
    }

    public function getNacimiento()
    {
        return $this->nacimientoc;
    }

    /*
    *   Métodos para gestionar la cuenta del cliente.
    */

    public function checkClient($alias)
    {
        $sql = 'SELECT id_cliente FROM clientes WHERE alias_c = ? or email_c = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->idc = $data['id_cliente'];
            $this->aliasc = $alias;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena FROM clientes WHERE id_cliente = ?';
        $params = array($this->idc);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['contrasena_c'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->clavec, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes SET contrasena = ? WHERE id_cliente = ?';
        $params = array($hash, $_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_cliente, nombres_c, apellidos_c, dui_c, email_c, telefono_c, fecha_nac
        FROM clientes WHERE apellidos_c ILIKE ? OR nombres_c ILIKE ? ORDER BY apellidos_c';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->clavec, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO clientes(nombres_c, apellidos_c, dui_c, email_c, alias_c, contrasena, telefono_c, fecha_nac)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombresc, $this->apellidosc, $this->duic, $this->emailc, $this->aliasc, $this->contrasenac, $this->telefonoc, $this->nacimientoc, $hash);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_cliente, nombres_c, apellidos_c, dui_c, email_c, alias_c, contrasena, telefono_c, fecha_nac
        FROM clientes';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_cliente, nombres_c, apellidos_c, dui_c, email_c, alias_c, contrasena, telefono_c, fecha_nac
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE clientes 
                SET nombres_c = ?, apellidos_c = ?, dui_c = ?, email_c = ?, alias_c = ?, contrasena = ?, telefono_c = ?, fecha_nac = ?
                WHERE id_cliente = ?';
        $params = array($this->nombresc, $this->apellidosc, $this->duic, $this->emailc, $this->aliasc, $this->clavec, $this->telefonc, $this->nacimientoc, $this->idc);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::executeRow($sql, $params);
    }
}



    

    

    

    

    

    

    

   

   

    
    

    

    

    

    

    

    


