<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Usuarios extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombres = null;
    private $apellidos = null;
    private $correo = null;
    private $alias = null;
    private $clave = null;
    private $tipo = null;
    private $estado = null;
    private $especialidad = null;
    private $sueldo = null;
    private $nacimiento = null;
    private $dui = null;
    private $telefono = null;

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

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->alias = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNacimineto($value)
    {
        if ($this->validateDate($value)) {
            $this->nacimiento = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setDUI($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEspecialidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->especialidad = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setSueldo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->sueldo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
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

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getDUI()
    {
        return $this->dui;
    }

    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getSueldo()
    {
        return $this->sueldo;
    }

    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }



    /*
    *   Métodos para gestionar la cuenta del usuario.
    */
    public function checkUser($alias)
    {
        $sql = 'SELECT id_usuario, estado_usuario FROM usuarios WHERE alias_u = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->estado = $data['estado_usuario'];
            $this->alias = $alias;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena FROM usuarios WHERE id_usuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['contrasena'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?';
        $params = array($hash, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT id_usuario, nombres_u, contrasena, dui_u, tipo_usuario, email_u, alias_u, apellidos, sueldo, telefono_u, estado_usuario, especialidad
        FROM usuarios INNER JOIN tipo_usuario USING(id_tipo_usuario)
        INNER JOIN especialidad USING(id_especialidad)
                WHERE id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE usuarios
                SET nombres_u = ?, apellidos = ?, email_u = ?, alias_u = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_usuario, nombres_u, apellidos, contrasena, dui_u, tipo_usuario, email_u, alias_u, apellidos, sueldo, telefono_u, estado_usuario, especialidad
        FROM usuarios INNER JOIN tipo_usuario USING(id_tipo_usuario)
        INNER JOIN especialidad USING(id_especialidad)
                WHERE apellidos ILIKE ? OR nombres_u ILIKE ?
                ORDER BY apellidos';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuarios(nombres_u, apellidos, email_u, id_tipo_usuario, alias_u, telefono_u, dui_u, estado_usuario, sueldo, id_especialidad, fecha_nacimiento, contrasena)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->correo, &$this->tipo, $this->alias, $this->telefono, $this->dui, $this->estado, $this->sueldo, $this->especialidad, $this->nacimiento, $hash);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_usuario, nombres_u, contrasena, dui_u, tipo_usuario, email_u, alias_u, apellidos, sueldo, telefono_u, estado_usuario, especialidad, fecha_nacimiento
        FROM usuarios INNER JOIN tipo_usuario USING(id_tipo_usuario)
        INNER JOIN especialidad USING(id_especialidad)
        ORDER BY apellidos';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAll2()
    {
        $sql = 'SELECT id_tipo_usuario, tipo_usuario from tipo_usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllEsp()
    {
        $sql = 'SELECT id_especialidad, especialidad from especialidad';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_usuario, nombres_u, apellidos, email_u, id_tipo_usuario, alias_u, telefono_u, dui_u, estado_usuario, sueldo, id_especialidad, fecha_nacimiento, contrasena
                FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE usuarios 
                SET nombres_u = ?, apellidos = ?, email_u = ?, id_tipo_usuario = ?, id_especialidad = ?, estado_usuario = ?, sueldo = ?, fecha_nacimiento = ?, telefono_u = ?, dui_u = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->tipo, $this->especialidad, $this->estado, $this->sueldo, $this->nacimiento, $this->telefono, $this->dui, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readUsuariosRpt($especialidad)
    {
        $sql = 'SELECT nombres_u, apellidos, alias_u, especialidad
        FROM usuarios INNER JOIN especialidad USING(id_especialidad)
        WHERE id_especialidad = ?
        ORDER BY especialidad';
        $params = array($especialidad);
        return Database::getRows($sql, $params);
    }

    public function readDetalleUserRpt()
    {
        $sql = 'SELECT nombres_u, apellidos, email_u, tipo_usuario, alias_u, telefono_u, dui_u, sueldo, especialidad, fecha_nacimiento
        FROM usuarios INNER JOIN especialidad USING(id_especialidad) INNER JOIN tipo_usuario USING(id_tipo_usuario)
        WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}
