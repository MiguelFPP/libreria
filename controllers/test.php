<?php
require_once 'models/Persona.php';
class PersonaController
{
    public function index()
    {
        require_once 'views/personas/listado.php';
    }

    public function gestion()
    {
        require_once 'views/personas/crear.php';
    }

    public function guardar()
    {
        if ($_POST) {
            $persona = new Persona();
            $identificacion = isset($_POST['identificacion']) ? mysqli_real_escape_string($persona->getDb(), $_POST['identificacion']) : false;
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($persona->getDb(), $_POST['nombre']) : false;
            $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($persona->getDb(), $_POST['apellido']) : false;
            $genero = isset($_POST['genero']) ? $_POST['genero'] : false;
            $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($persona->getDb(), $_POST['telefono']) : false;
            $nacimiento = isset($_POST['nacimiento']) ? $_POST['nacimiento'] : false;
            $correo = isset($_POST['correo']) ? mysqli_real_escape_string($persona->getDb(), $_POST['correo']) : false;

            $errores = array();

            if (!is_numeric($identificacion) || !filter_var($identificacion, FILTER_VALIDATE_INT)) {
                $errores['identificacion'] = 'Indentificacion no valida';
            }
            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Nombre no valido';
            }
            if (!is_string($apellido) || preg_match("/[0-9]/", $apellido)) {
                $errores['apellido'] = 'Apellido no valido';
            }
            if ($genero < 1) {
                $errores['genero'] = 'Seleccione un genero';
            }
            if (!is_numeric($telefono) || !filter_var($telefono, FILTER_VALIDATE_INT)) {
                $errores['telefono'] = 'Numero de telefono no valido';
            }
            if (!is_string($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = 'Direccion  de correo no valido';
            }

            if (count($errores) == 0) {

                $persona->setIdentificacion($identificacion);
                $persona->setNombre($nombre);
                $persona->setApellido($apellido);
                $persona->setGenero($genero);
                $persona->setTelefono($telefono);
                $persona->setNacimiento($nacimiento);
                $persona->setCorreo($correo);

                /* guardar la iamgen */
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $type = $file['type'];

                    if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $persona->setImagene($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                /* comprueba si viene el id por get para determinar si hay que editar o crear */
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $persona->setId($id);
                    $save = $persona->editar();
                } else {
                    /* comprobacion de los campos unico en la bd */
                    $compIdentificacion = $persona->comprobarIdentificacion($identificacion);
                    $compCorreo = $persona->comprobarCorreo($correo);
                    $compTelefono = $persona->comprobarTelefono($telefono);
                    /* si algun dato ya existe se creara una session para usarla como mensaje de error */
                    if ($compIdentificacion->identificacion == $identificacion) {
                        $_SESSION['register'] = 'comprobarIdentificacion';
                        header('location: ' . base_url . 'persona/gestion');
                    } elseif ($compCorreo->correo == $correo) {
                        $_SESSION['register'] = 'comprobarCorreo';
                        header('location: ' . base_url . 'persona/gestion');
                    } elseif ($compTelefono->telefono == $telefono) {
                        $_SESSION['register'] = 'comprobarTelefono';
                        header('location: ' . base_url . 'persona/gestion');
                    } else {
                        $save = $persona->guardar();
                    }
                }

                if ($save) {
                    $_SESSION['register'] = 'complete';
                    header('location: ' . base_url . 'persona/index');
                }/*  else {
                    $_SESSION['register'] = 'failed';
                    header('location: ' . base_url . 'persona/gestion');
                } */
            } else {
                $_SESSION['register'] = 'failed';
                header('location: ' . base_url . 'persona/gestion');
            }
        }
        /* var_dump($errores);
        die(); */
    }

    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $persona = new Persona();
            $persona->setId($id);
            $per = $persona->onePer();

            require_once 'views/personas/crear.php';
        } else {
            header('location:' . base_url . 'persona/index');
        }
    }

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $persona = new Persona();
            $persona->setId($id);

            $borrado = $persona->borrar();

            if ($borrado) {
                $_SESSION['register'] = 'complete';
            } else {
                $_SESSION['register'] = 'failed';
            }
        }
        header('location:' . base_url . 'persona/index');
    }
}
