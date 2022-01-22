<?php
class Utils
{
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function borrar_alertas()
    {
        $borrado = false;

        if (isset($_SESSION['error_datos'])) {
            $_SESSION['error_datos'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['register'])) {
            $_SESSION['register'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['edit'])) {
            $_SESSION['edit'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['delete'])) {
            $_SESSION['delete'] = null;
            $borrado = true;
        }

        return $borrado;
    }

    public static function erroresDatos($error, $campo)
    {
        $alerta = "";
        if (isset($error[$campo]) && !empty($campo)) {
            $alerta = '<div class="alert alert-warning mt-2" role="alert">
            ' . $error[$campo] . '
          </div>';
        }
        return $alerta;
    }

    public static function showCategorias()
    {
        require_once 'models/Categoria.php';
        $categoria = new Categoria;
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function showAutores()
    {
        require_once 'models/Autor.php';
        $autor = new Autor;
        $autores = $autor->getAll();

        return $autores;
    }

    public static function showPersonas()
    {
        require_once 'models/Persona.php';
        $persona = new Persona;

        $personas = $persona->getAll();

        return $personas;
    }

    public static function showLibros()
    {
        require_once 'models/Libro.php';
        $libro = new Libro;

        $libros = $libro->getAll();

        return $libros;
    }
}
