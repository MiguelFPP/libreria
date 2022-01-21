<?php
class Autor
{
    private $id;
    private $nombre;

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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

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
        $sql = "insert into autor values (null, '{$this->getNombre()}')";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getAll()
    {
        $sql = "select * from autor";
        $autores = $this->db->query($sql);

        return $autores;
    }

    public function getOne()
    {
        $sql = "select * from autor where id={$this->getId()}";
        $autor = $this->db->query($sql);

        return $autor->fetch_object();
    }
}
