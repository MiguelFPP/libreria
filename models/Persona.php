<?php
class Persona
{
    private $id;
    private $identificacion;
    private $nombre;
    private $apellido;
    private $correo;
    private $rol;

    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getApellido()
    {
        return $this->apellido;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }


    public function getCorreo()
    {
        return $this->correo;
    }


    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }


    public function getRol()
    {
        return $this->rol;
    }


    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of identificacion
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set the value of identificacion
     *
     * @return  self
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }


    public function getDb()
    {
        return $this->db;
    }


    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function save()
    {
        $sql = "insert into persona values (null, {$this->getIdentificacion()}, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getCorreo()}', '{$this->getRol()}')";

        $save = $this->db->query($sql);
        $persona_id = $this->db->insert_id;

        if ($this->getRol() != 'client') {
            $contraseniaEn = md5($this->getIdentificacion());
            $sql2 = "insert into usuario values (null, '{$this->getCorreo()}', '{$contraseniaEn}', 'a', {$persona_id})";
            $save2 = $this->db->query($sql2);
        }

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getAll()
    {
        $sql = "select persona.* from persona where persona.id not in (select usuario.persona from usuario)";
        $usuario = $this->db->query($sql);

        return $usuario;
    }

    public function getOne()
    {
        $sql = "select * from persona where id={$this->getId()}";
        $persona = $this->db->query($sql);

        return $persona->fetch_object();
    }
}