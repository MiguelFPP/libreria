<?php
require_once 'models/Libro.php';

class LibroController extends BaseController
{
    public function gestion()
    {
        include_once 'views/libro/gestion.php';
    }

    public function crear()
    {
        include_once 'views/libro/crear.php';
    }

    public function editar()
    {
        $libro = new Libro;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $libro->setId($id);

            $lib = $libro->getOne();

            include_once 'views/libro/crear.php';
        } else {
            $this->redirect('libro', 'gestion');
        }
    }
    public function save()
    {
        $libro = new Libro;
        if ($_POST) {
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($libro->getDb(), $_POST['nombre']) : false;
            $editorial = isset($_POST['editorial']) ? mysqli_real_escape_string($libro->getDb(), $_POST['editorial']) : false;
            $stock = isset($_POST['stock']) ? mysqli_real_escape_string($libro->getDb(), $_POST['stock']) : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $autor = isset($_POST['autor']) ? $_POST['autor'] : false;

            $errores = array();

            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Ingrese un nombre valido';
            }
            if (!is_string($editorial) || preg_match("/[0-9]/", $editorial)) {
                $errores['editorial'] = 'Ingrese un nombre de editorial valido';
            }
            if (!is_numeric($stock) || !filter_var($stock, FILTER_VALIDATE_INT)) {
                $errores['stock'] = 'Ingrese un valor de stock valido';
            }
            if ($categoria == 0) {
                $errores['categoria'] = 'Seleccione una categoria';
            }
            if ($autor == 0) {
                $errores['autor'] = 'Seleccione un autor';
            }

            if (count($errores) == 0) {
                $libro->setNombre($nombre);
                $libro->setEditorial($editorial);
                $libro->setStock($stock);
                $libro->setCategoria($categoria);
                $libro->setAutor($autor);

                $save = $libro->save();

                if ($save) {
                    $_SESSION['register'] = 'complete';
                    $this->redirect('libro', 'gestion');
                } else {
                    $_SESSION['register'] = 'failed';
                    $this->redirect('libro', 'crear');
                }
            } else {
                $_SESSION['error_datos'] = $errores;
                /* var_dump($_SESSION['error_datos']);
                die(); */
                $this->redirect('libro', 'crear');
            }
        }
    }
}
