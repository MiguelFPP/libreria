<?php
class Prestamo
{
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $estado;
    private $persona;
    private $personaPres;

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
     * Get the value of fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaFin
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaFin
     *
     * @return  self
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

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

    /**
     * Get the value of personaPres
     */
    public function getPersonaPres()
    {
        return $this->personaPres;
    }

    /**
     * Set the value of personaPres
     *
     * @return  self
     */
    public function setPersonaPres($personaPres)
    {
        $this->personaPres = $personaPres;

        return $this;
    }

    public function prestamosNoConcluidos()
    {
        $sql = "SELECT prestamo.*, persona.nombre, persona.apellido, persona.identificacion, persona.correo from prestamo INNER JOIN persona on prestamo.persona=persona.id WHERE prestamo.estado != 'entr'";

        $prestamo = $this->db->query($sql);

        return $prestamo;
    }

    /* funcion para terminar un prestamos */
    public function terminar()
    {
        $sql = "update prestamo set estado='entr' where id={$this->getId()}";

        $edit = $this->db->query($sql);
        $result = false;

        if ($edit) {
            $result = true;
        }
        return $result;
    }

    public function save()
    {
        $sql = "INSERT INTO prestamo VALUES(NULL, '{$this->getFechaInicio()}', '{$this->getFechaFin()}', 'pres', {$this->getPersona()}, {$this->getPersonaPres()})";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function save_prestamos_libro()
    {
        $sql = "SELECT LAST_INSERT_ID() AS 'prestamo'";
        $query = $this->db->query($sql);
        $prestamo_id = $query->fetch_object()->prestamo;

        foreach ($_SESSION['carrito'] as $elemento) {
            $libro = $elemento['libro'];

            $insert = "insert into prestamo_libro values(null, null, {$prestamo_id}, {$libro->id})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
