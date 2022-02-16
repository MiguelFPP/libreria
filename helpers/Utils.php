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

        if (isset($_SESSION['term'])) {
            $_SESSION['term'] = null;
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

    public static function showCliente()
    {
        require_once 'models/Persona.php';
        $persona = new Persona;

        $personas = $persona->getAllClientes();

        return $personas;
    }

    public static function showUsuarioRol()
    {
        if (isset($_SESSION['admin'])) {
            $personas = Utils::showPersonas();
        } elseif (isset($_SESSION['secret'])) {
            $personas = Utils::showCliente();
        }

        return $personas;
    }

    public static function showLibros()
    {
        require_once 'models/Libro.php';
        $libro = new Libro;

        $libros = $libro->getAll();

        return $libros;
    }

    public static function getAllClientLibres()
    {
        require_once 'models/Persona.php';
        $usuario = new Persona;
        $usuarios = $usuario->getClientesLibres();

        return $usuarios;
    }
}
