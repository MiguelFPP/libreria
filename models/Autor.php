<?php
class Autor
{
    private $id;
    private $nombre;
    private $estado;

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

    public function save()
    {
        $sql = "insert into autor values (null, '{$this->getNombre()}', 'a')";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getAll()
    {
        $sql = "select * from autor where estado != 'i'";
        $autores = $this->db->query($sql);

        return $autores;
    }

    public function getOne()
    {
        $sql = "select * from autor where id={$this->getId()}";
        $autor = $this->db->query($sql);

        return $autor->fetch_object();
    }

    public function edit()
    {
        $sql = "update autor set nombre='{$this->getNombre()}' where id={$this->getId()}";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "update autor set estado='i' where id={$this->getId()}";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
