<?php
class Categoria
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
        $sql = "insert into categoria values (null, '{$this->getNombre()}')";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getAll()
    {
        $sql = "select * from categoria";
        $categorias = $this->db->query($sql);

        return $categorias;
    }

    public function getOne()
    {
        $sql = "select * from categoria where id={$this->getId()}";
        $categoria = $this->db->query($sql);

        return $categoria->fetch_object();
    }

    public function edit()
    {
        $sql = "update categoria set nombre='{$this->getNombre()}' where id={$this->getId()}";
        $edit = $this->db->query($sql);

        $result = false;

        if ($edit) {
            $result = true;
        }

        return $result;
    }

    public function delete()
    {
        $sql = "delete from categoria where id={$this->getId()}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}
