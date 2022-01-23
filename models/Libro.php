<?php
class Libro
{
    private $id;
    private $nombre;
    private $autor;
    private $categoria;
    private $editorial;
    private $fecha;
    private $stock;

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
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     * @return  self
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of editorial
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set the value of editorial
     *
     * @return  self
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

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
        $sql = "insert into libro values (null, '{$this->getNombre()}', '{$this->getEditorial()}', {$this->getStock()}, curdate(), {$this->getCategoria()}, {$this->getAutor()})";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function getAll()
    {
        $sql = "select libro.id, libro.nombre, autor.id as autor_id, autor.nombre as autor, categoria.id as categoria_id, categoria.nombre as categoria, libro.editorial, libro.stock from libro
        INNER JOIN autor ON libro.autor=autor.id
        INNER JOIN categoria ON libro.categoria=categoria.id;";
        $categorias = $this->db->query($sql);

        return $categorias;
    }

    public function getOne()
    {
        $sql = "select libro.id, libro.nombre, autor.id as autor_id, autor.nombre as autor, categoria.nombre as categoria, categoria.id as categoria_id, libro.editorial, libro.stock from libro
        INNER JOIN autor ON libro.autor=autor.id
        INNER JOIN categoria ON libro.categoria=categoria.id where libro.id={$this->getId()}";

        $libro = $this->db->query($sql);

        return $libro->fetch_object();
    }
}
