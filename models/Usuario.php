<?php
class Usuario
{
    private $id;
    private $usuario;
    private $contrasenia;
    private $estado;
    private $persona;

    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of contrasenia
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * Set the value of contrasenia
     *
     * @return  self
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set the value of persona
     *
     * @return  self
     */
    public function setPersona($persona)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function save()
    {
        $sql = "insert into usuario values (null, '{$this->getUsuario()}', '{$this->getContrasenia()}', 'a', {$this->getPersona()})";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getOne()
    {
        $sql = "select usuario.estado from usuario where persona={$this->getPersona()}";
        $usuario = $this->db->query($sql);

        return $usuario->fetch_object();
    }
}
