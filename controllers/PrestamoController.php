<?php
require_once 'models/Libro.php';
require_once 'models/Persona.php';
require_once 'models/Prestamo.php';
class PrestamoController extends BaseController
{
    public function gestion()
    {
        include_once "views/prestamo/gestion.php";
    }

    public function librosPrestamo()
    {
        include_once "views/prestamo/librosPrestamo.php";
    }


    public function usuariosPrestamo()
    {
        include_once "views/prestamo/usuariosPrestamo.php";
    }

    /* funcion que vrifica si existe un carrito de lo contrario lo crea*/
    public function carrito()
    {
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }
        include_once 'views/carrito/carrito.php';
    }


    public function add()
    {
        if (isset($_GET['id'])) {
            $libro_id = $_GET['id'];
        } else {
            $this->redirect('admin', 'index');
        }

        /* verifica si el id ya esta en el array para evitar mostrar el libro repetido */
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_libro'] == $libro_id) {
                    /* $_SESSION['carrito'][$indice]['unidades']++; */
                    $counter++;
                }
            }
        }
        if (!isset($counter)  || $counter == 0) {
            /* conseguir prodcutpo */
            $libro = new Libro();
            $libro->setId($libro_id);
            $libro = $libro->getOne();

            /* añadir al carrito */
            if (is_object($libro)) {
                $_SESSION['carrito'][] = array(
                    "id_libro" => $libro->id,
                    "nombre" => $libro->nombre,
                    "libro" => $libro
                );
            }
        }
        $this->redirect('prestamo', 'librosPrestamo');
    }

    public function limpiarCarrito()
    {
        unset($_SESSION['carrito']);
        $this->redirect('prestamo', 'gestion');
    }

    public function quitarLibro()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        $this->redirect('prestamo', 'carrito');
    }

    public static function prestamosNoConcluidos()
    {
        $prestamo = new Prestamo;
        $prestamos = $prestamo->prestamosNoConcluidos();

        return $prestamos;
    }

    public function terminar()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $prestamo = new Prestamo;

            $prestamo->setId($id);
            $term = $prestamo->terminar();

            if ($term) {
                $_SESSION['term'] = 'complete';
                $this->redirect('prestamo', 'gestion');
            } else {
                $_SESSION['term'] = 'failed';
                $this->redirect('prestamo', 'editar');
            }
        } else {
            $this->redirect('prestamo', 'gestion');
        }
    }
}
