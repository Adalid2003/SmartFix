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
    private $genero = null;
    private $estado = null;

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

    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
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

    public function setGenero($value)
    {
        if ($this->validateAlphanumeric($value, 1, 2)) {
            $this->genero = $value;
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

    public function getEstado()
    {
        return $this->estado;
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

    public function getGenero()
    {
        return $this->genero;
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

    //Consulta para saber los repuestos de las citas de un cliente
    public function clientsReplacements()
    {
        $sql = 'SELECT CONCAT (nombres_c,\' \',apellidos_c) as cliente, repuesto, CONCAT(nombres_u,\' \',apellidos) as empleado FROM facturacion
                INNER JOIN clientes USING (id_cliente)
                INNER JOIN detalle_reparacion USING (id_detalle_rep)
                INNER JOIN usuarios USING (id_usuario)
                WHERE facturacion.id_cliente = ?';
        $params = array($this->idc);
        return Database::getRows($sql, $params);
    }

    //Consulta para saber los clientes por genero
    public function clientsByGender()
    {
        $sql = 'SELECT CONCAT(nombres_c,\' \',apellidos_c) as cliente, dui_c, alias_c, telefono_c 
                FROM clientes 
                WHERE genero = ?';
        $params = array($this->genero);
        return Database::getRows($sql, $params);
    }

    public function checkClient($correo)
    {
        $sql = 'SELECT id_cliente, estado_cliente FROM clientes WHERE email_c = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->idc = $data['id_cliente'];
            $this->estado = $data['estado_cliente'];
            $this->emailc = $correo;
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
        if (password_verify($password, $data['contrasena'])) {
            return true;
        } else {
            return false;
        }
    }

    //funcion para sumar un intento luego de fallar la contraseña
    public function increaseAttempt()
    {
        $sql = 'UPDATE clientes SET intentos = intentos + 1 WHERE email_c = ?';
        $params = array($this->emailc);
        return Database::executeRow($sql, $params);
    }

    //funcion para resetear los intentos luego de iniciar sesión
    public function resetAttempts()
    {
        $sql = 'UPDATE clientes SET intentos = 0 WHERE email_c = ?';
        $params = array($this->emailc);
        return Database::executeRow($sql, $params);
    }

    //funcion para obtener la cantidad de intentos de un usuario
    public function getAttempts()
    {
        $sql  = 'SELECT intentos FROM clientes WHERE email_c = ?';
        $params = array($this->emailc);
        return Database::getRow($sql, $params);
    }

    //funcion para actualizar el estado de un usuario a false
    public function updateStateToFalse()
    {
        $sql = 'UPDATE clientes SET estado_cliente = false WHERE email_c = ?';
        $params = array($this->emailc);
        return Database::executeRow($sql, $params);
    }

    //funcion para verificar si ya cumplieron los 90 dias de la contraseña de un usuario
    public function checkIfPasswordHas90Days()
    {
        $sql = 'SELECT*FROM clientes WHERE fecha_clave < current_date - 90 AND email_c = ?';
        $params = array($this->emailc);
        return Database::getRow($sql, $params);
    }

    //funcion para actualizar la fecha de cambio de clave a la actual
    public function setNewPassword90Days()
    {
        $sql = 'UPDATE clientes SET fecha_clave = current_date WHERE id_cliente = ?';
        $params = array($_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
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
        $sql = 'INSERT INTO clientes(nombres_c, apellidos_c, dui_c, email_c, alias_c,telefono_c, fecha_nac, contrasena, genero)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombresc, $this->apellidosc, $this->duic, $this->emailc, $this->aliasc, $this->telefonoc, $this->nacimientoc, $hash, $this->genero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_cliente, nombres_c, apellidos_c, dui_c, email_c, alias_c, contrasena, telefono_c, fecha_nac, genero
        FROM clientes';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_cliente, nombres_c, apellidos_c, dui_c, email_c, alias_c, contrasena, telefono_c, fecha_nac, genero
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE clientes 
                SET nombres_c = ?, apellidos_c = ?, dui_c = ?, email_c = ?, telefono_c = ?, fecha_nac = ?, genero = ?
                WHERE id_cliente = ?';
        $params = array($this->nombresc, $this->apellidosc, $this->duic, $this->emailc, $this->telefonoc, $this->nacimientoc, $this->genero, $this->idc);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::executeRow($sql, $params);
    }

    public function rptCitasCliente()
    {
        $sql = 'SELECT id_cita,fecha_cita,nombres_c, apellidos_c,estado_cita, hora, razon
        FROM cita INNER JOIN clientes USING(id_cliente) INNER JOIN estado_cita USING(id_estado_cita) INNER JOIN hora_cita USING(id_hora)
        WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::getRows($sql, $params);
    }

    public function cantidadCitasCliente()
    {
        $sql = 'SELECT EXTRACT(MONTH FROM fecha_cita::date) as mes, count(id_cita) cantidad from cita where id_cliente = ? group by fecha_cita limit 6';
        $params = array($this->idc);
        return Database::getRows($sql, $params);
    }

    public function verificarEstado(){
        if ($this->estado == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarIntentos(){
        $sql = 'SELECT intentos
        FROM clientes
        WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function actualizarIntentos($intentos)
    {
        $sql = 'UPDATE clientes 
                SET intentos = ?
                WHERE id_cliente = ?';
        $params = array($intentos, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function actualizarEstado($estado)
    {
        $sql = 'UPDATE clientes
                SET estado_cliente = ?
                WHERE id_cliente = ?';
        $params = array($estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function accionCliente($observacion)
    {
        $sql = 'INSERT INTO bitacora(id_cliente,fecha,hora,observacion) 
                VALUES(?,current_date,current_time,?)';
        $params = array($this->id, $observacion);
        return Database::executeRow($sql, $params);
    }

    public function verificar90dias(){
        $sql = 'SELECT fecha_clave FROM clientes 
                WHERE id_cliente = ? AND fecha_clave > (SELECT current_date - 90)';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function changePasswordOut()
    {
        $hash = password_hash($this->clavec, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes SET contrasena = ? WHERE id_cliente = ?';
        $params = array($hash, $_SESSION['id_cliente_tmp']);
        return Database::executeRow($sql, $params);
    }

    public function actualizarFecha()
    {
        $sql = 'UPDATE clientes 
                SET fecha_clave = current_date
                WHERE id_cliente = ?';
        $params = array($this->idc);
        return Database::executeRow($sql, $params);
    }

    public function checkEmail()
    {
        $sql = 'SELECT email_c ,id_cliente FROM clientes WHERE email_c = ?';
        $params = array($this->emailc);
        return Database::getRow($sql, $params);
    }

    public function createHistorial()
    {
        // Se hace la consullta para llevar a cabo la acción
        $sql = 'INSERT INTO historial_sesion_c(dispositivo, fecha, hora, id_cliente)
                VALUES(? ,  current_date, current_time, ?)';
        $params = array(php_uname(), $_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
    }

    public function readHistorial()
    {
        // Se hace la consullta para llevar a cabo la acción
        $sql = 'SELECT id_sesion_c, dispositivo, fecha, hora, nombres_c
                FROM historial_sesion_c INNER JOIN clientes USING(id_cliente)
                WHERE id_cliente = ?
                ORDER BY nombres_c';
        $params = array($_SESSION['id_cliente']);
        return Database::getRows($sql, $params);
    }

    /*public function generosClientes()
    {
        $sql = ''
    }*/
}
