<?php
class Prestamo
{
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $fechaEntrega;
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
     * Get the value of fechaEntrega
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set the value of fechaEntrega
     *
     * @return  self
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

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
    public function terminar($multa)
    {
        $sql = "UPDATE prestamo SET fechaEntrega=CURDATE(), estado='entr', multa='$multa' WHERE id={$this->getId()}";

        $edit = $this->db->query($sql);
        $result = false;

        if ($edit) {
            $result = true;
        }
        return $result;
    }

    /* inicia un nuevo prestamo en la bd */
    public function save()
    {
        $sql = "INSERT INTO prestamo VALUES(NULL, '{$this->getFechaInicio()}', '{$this->getFechaFin()}', 'null', 'pres', 'n', {$this->getPersona()}, {$this->getPersonaPres()})";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    /* guarda el array de libros en el ultimo prestamo de la bd */
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

    public function getOne()
    {
        $sql = "SELECT * FROM prestamo WHERE id={$this->getId()}";
        $prestamo = $this->db->query($sql);

        return $prestamo->fetch_object();
    }

    /* funcion que lista los usuarios que halla hallan hceho prestamos */
    public function usuariosPrestamosGen()
    {
        $sql = "SELECT persona.id, persona.identificacion, persona.nombre, persona.apellido, prestamo.id AS idPrestamo, COUNT(prestamo.persona) AS cantPres, prestamo_libro.id AS prestamo_libro FROM persona
        INNER JOIN prestamo ON persona.id=prestamo.persona
        INNER JOIN prestamo_libro ON prestamo.id=prestamo_libro.id
        GROUP BY persona.id";

        $prestamo = $this->db->query($sql);

        return $prestamo;
    }

    public function prestamosPorUsuario()
    {
        $sql = "SELECT prestamo.*, COUNT(prestamo_libro.prestamo) AS cantLib, persona.nombre as presNombre, persona.apellido as presApellido FROM persona 
        INNER JOIN prestamo ON persona.id=prestamo.persona OR persona.id=prestamo.persona_pres
        INNER JOIN prestamo_libro on prestamo.id=prestamo_libro.prestamo
        WHERE persona.id={$this->getPersona()} GROUP BY prestamo_libro.prestamo";

        $prestamo = $this->db->query($sql);

        return $prestamo;
    }

    /* consulta que trae la informacion de prestamos dependiendo el id del prestamo */
    public function rPrestamo()
    {
        $sql = "SELECT prestamo.*, persona.identificacion as perIdentificacion,persona.nombre as perNombre, persona.apellido as perApellido, persona.correo as perCorreo, libro.nombre as libNombre, libro.editorial as libEditorial, autor.nombre as autor, categoria.nombre as categoria from prestamo
        INNER JOIN persona ON prestamo.persona=persona.id
        INNER JOIN prestamo_libro ON prestamo.id=prestamo_libro.prestamo
        INNER JOIN libro ON prestamo_libro.libro=libro.id
        INNER JOIN autor ON libro.autor=autor.id
        INNER JOIN categoria ON libro.categoria=categoria.id
        WHERE prestamo.id={$this->getId()}";

        $prestamoUsu = $this->db->query($sql);

        return $prestamoUsu;
    }

    /* consulta que trae la informacion del admin o secret que realizo el prestamo 
    dependiendo el id del prestamo */
    public function infoPerPrestamo()
    {
        $sql = "SELECT persona.nombre, persona.apellido, persona.correo from prestamo
        INNER JOIN persona ON prestamo.persona_pres=persona.id
        where prestamo.id={$this->getId()}";

        $perPrestamo = $this->db->query($sql);

        return $perPrestamo->fetch_object();
    }
}
