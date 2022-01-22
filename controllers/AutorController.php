<?php
require_once 'models/Autor.php';
class AutorController extends BaseController
{
    public function gestion()
    {
        include_once 'views/autor/gestion.php';
    }

    public function crear()
    {
        include_once 'views/autor/crear.php';
    }

    public function save()
    {
        if ($_POST) {
            $autor = new Autor;
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($autor->getDb(), $_POST['nombre']) : false;

            $errores = array();

            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Nombre no valido';
            }

            if (count($errores) == 0) {
                $autor->setNombre($nombre);

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $autor->setId($id);
                    $edit = $autor->edit();

                    if ($edit) {
                        $_SESSION['edit'] = 'complete';
                        $this->redirect('autor', 'gestion');
                    } else {
                        $_SESSION['edit'] = 'failed';
                        $this->redirect('autor', 'editar');
                    }
                } else {
                    $save = $autor->save();

                    if ($save) {
                        $_SESSION['register'] = 'complete';
                        $this->redirect('autor', 'gestion');
                    } else {
                        $_SESSION['retgister'] = 'failed';
                        $this->redirect('autor', 'crear');
                    }
                }
            } else {
                $_SESSION['error_datos'] = $errores;
                $this->redirect('autor', 'crear');
            }
        }
    }

    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $autor = new Autor;
            $autor->setId($id);

            $aut = $autor->getOne();

            include_once 'views/autor/crear.php';
        } else {
            $this->redirect('autor', 'gestion');
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $autor = new Autor;
            $autor->setId($id);
            $delete = $autor->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        }
        $this->redirect('autor', 'gestion');
    }
}
