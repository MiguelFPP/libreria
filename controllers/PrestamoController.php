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

    public function usuarios()
    {
        include_once "views/prestamo/usuarios.php";
    }

    public function previewPrestamo()
    {
        $carrito = $_SESSION['carrito'];
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $persona = new Persona;
            $persona->setId($id);
            $per = $persona->getOne();
        } else {
            $this->redirect('Prestamo', 'gestion');
        }
        include_once 'views/prestamo/visualizacion.php';
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
            $this->redirect('Pdmin', 'index');
        }

        /* verifica si el id ya esta en el array para evitar mostrar el libro repetido */
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_libro'] == $libro_id) {
                    /* $_SESSION['carrito'][$indice]['unidades']++; */
                    $counter++;
                    $_SESSION['carrito_repit'] = 'complete';
                }
            }
        }
        if (!isset($counter)  || $counter == 0) {
            /* conseguir prodcutpo */
            $libro = new Libro();
            $libro->setId($libro_id);
            $libro = $libro->getOne();

            /* a??adir al carrito */
            if (is_object($libro)) {
                $_SESSION['carrito'][] = array(
                    "id_libro" => $libro->id,
                    "nombre" => $libro->nombre,
                    "libro" => $libro
                );
                $_SESSION['carrito_add'] = 'complete';
            }
        }
        $this->redirect('Prestamo', 'librosPrestamo');
    }

    public function limpiarCarrito()
    {
        unset($_SESSION['carrito']);
        $this->redirect('Prestamo', 'gestion');
    }

    public function quitarLibro()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        $this->redirect('Prestamo', 'carrito');
    }

    public static function prestamosNoConcluidos()
    {
        $prestamo = new Prestamo;
        $prestamos = $prestamo->prestamosNoConcluidos();

        return $prestamos;
    }

    public function save_prestamo()
    {
        if (isset($_SESSION['identity'])) {
            $persona_pres = $_SESSION['identity']->id;
            if (isset($_GET['id'])) {
                $persona_id = $_GET['id'];
                $fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
                $fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] : false;

                if ($fechaInicio && $fechaFin) {
                    $prestamo = new Prestamo;
                    $prestamo->setFechaInicio($fechaInicio);
                    $prestamo->setFechaFin($fechaFin);
                    $prestamo->setPersona($persona_id);
                    $prestamo->setPersonaPres($persona_pres);

                    /* guardar  datos basicos del prestamo en la tabla de bd*/
                    $save = $prestamo->save();

                    /* guardar array de libros tabla prestamo_libro maestro detalle */
                    $save_prestamo = $prestamo->save_prestamos_libro();

                    if ($save && $save_prestamo) {
                        $_SESSION['prestamo'] = 'complete';
                        unset($_SESSION['carrito']);
                        $this->redirect('Prestamo', 'gestion');
                    }
                } else {
                    $_SESSION['prestamo'] = 'failed';
                    $this->redirect('Prestamo', 'previewPrestamo&id=' . $persona_id);
                }
            } else {
                $this->redirect('Prestamo', 'usuariosPrestamo');
            }
        }
    }

    /* controlador que termina un prestamo */
    public function terminar()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $prestamo = new Prestamo;

            $prestamo->setId($id);
            $pres = $prestamo->getOne();

            if ($pres->fechaFin < date('Y-m-d')) {
                $term = $prestamo->terminar('s');
            } else {
                $term = $prestamo->terminar('n');
            }

            if ($term) {
                $_SESSION['term'] = 'complete';
                $this->redirect('Prestamo', 'gestion');
            } else {
                $_SESSION['term'] = 'failed';
                $this->redirect('Prestamo', 'editar');
            }
        } else {
            $this->redirect('Prestamo', 'gestion');
        }
    }

    public static function usuariosConPrestamos()
    {
        $prestamo = new Prestamo;
        $prestamos = $prestamo->usuariosPrestamosGen();

        return $prestamos;
    }

    /* trae todos los prestamos que ha hecho el usuario */
    public function prestamosPorUsuario()
    {
        if ($_GET['id']) {
            $prestamo = new Prestamo;
            $persona_id = $_GET['id'];
            $prestamo->setPersona($persona_id);
            $prestamos = $prestamo->prestamosPorUsuario();


            include_once 'views/prestamo/registroUsuarios.php';
            return $prestamos;
        } else {
            $this->redirect('Prestamo', 'usuarios');
        }
    }

    /* funcion del controlado que virifica si viene un id por url y trae informacion 
    de prestamos dependiendo el id*/
    public function infoPrestamos()
    {
        $prestamo = new Prestamo;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $prestamo->setId($id);
            /* informacion general del prestamo ya existente */
            $pres = $prestamo->rPrestamo();
            /* informacion del admin o secret que realizo el prestamo */
            $perPrestamos = $prestamo->infoPerPrestamo();
            include_once "views/prestamo/registroPrestamo.php";
        } else {
            $this->redirect('Prestamo', 'usuarios');
        }
    }
}
