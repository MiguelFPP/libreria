<?php
require_once 'models/Categoria.php';
class CategoriaController extends BaseController
{
    public function gestion()
    {
        include_once 'views/categoria/gestion.php';
    }

    public function crear()
    {
        include_once 'views/categoria/crear.php';
    }

    public function save()
    {
        if ($_POST) {
            $categoria = new Categoria;
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($categoria->getDb(), $_POST['nombre']) : false;

            $errores = array();

            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Nombre no valido';
            }

            if (count($errores) == 0) {
                $categoria->setNombre($nombre);

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $categoria->setId($id);
                    $edit = $categoria->edit();

                    if ($edit) {
                        $_SESSION['edit'] = 'complete';
                        $this->redirect('Categoria', 'gestion');
                    } else {
                        $_SESSION['edit'] = 'failed';
                        $this->redirect('Categoria', 'editar');
                    }
                } else {
                    $save = $categoria->save();

                    if ($save) {
                        $_SESSION['register'] = 'complete';
                        $this->redirect('Categoria', 'gestion');
                    } else {
                        $_SESSION['retgister'] = 'failed';
                        $this->redirect('Categoria', 'editar');
                    }
                }
            } else {
                $_SESSION['error_datos'] = $errores;
                $this->redirect('Categoria', 'crear');
            }
        }
    }

    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $categoria = new Categoria;
            $categoria->setId($id);

            $cat = $categoria->getOne();

            include_once 'views/categoria/crear.php';
        } else {
            $this->redirect('Categoria', 'gestion');
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $categoria = new Categoria;
            $categoria->setId($id);

            $delete = $categoria->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        }
        $this->redirect('Categoria', 'gestion');
    }
}
