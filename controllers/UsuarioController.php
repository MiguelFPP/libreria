<?php
require_once 'models/Persona.php';
require_once 'models/Usuario.php';
class UsuarioController extends BaseController
{
    public function gestion()
    {
        include_once 'views/usuario/gestion.php';
    }

    public function crear()
    {
        include_once 'views/usuario/crear.php';
    }

    public function save()
    {
        if ($_POST) {
            $persona = new Persona;
            $usuario = new Usuario;

            $identifiacion = isset($_POST['identificacion']) ? mysqli_real_escape_string(
                $persona->getDb(),
                $_POST['identificacion']
            ) : false;
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($persona->getDb(), $_POST['nombre']) : false;
            $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($persona->getDb(), $_POST['apellido']) : false;
            $correo = isset($_POST['correo']) ? mysqli_real_escape_string($persona->getDb(), $_POST['correo']) : false;
            $rol = isset($_POST['rol']) ? mysqli_real_escape_string($persona->getDb(), $_POST['rol']) : false;

            $errores = array();

            if (!is_numeric($identifiacion) || !filter_var($identifiacion, FILTER_VALIDATE_INT)) {
                $errores['identificacion'] = 'Identificacion no valida';
            }
            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Nombre no valido';
            }
            if (!is_string($apellido) || preg_match("/[0-9]/", $apellido)) {
                $errores['apellido'] = 'Apellido no valido';
            }
            if (!is_string($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = 'Correo no valido';
            }
            if ($rol == 0) {
                $errores['rol'] = 'Seleccion un rol';
            }

            if (count($errores) == 0) {
                $persona->setIdentificacion($identifiacion);
                $persona->setNombre($nombre);
                $persona->setApellido($apellido);
                $persona->setCorreo($correo);
                $persona->setRol($rol);

                $save = $persona->save();
                $persona_id = $persona->getDb()->insert_id;

                if ($rol != 'client') {
                    $usuario->setUsuario($correo);
                    $usuario->setContrasenia($identifiacion);
                    $usuario->setPersona($persona_id);

                    $save = $usuario->save();
                }

                if ($save) {
                    $_SESSION['register'] = 'complete';
                    $this->redirect('Usuario', 'gestion');
                } else {
                    $_SESSION['register'] = 'failed';
                    $this->redirect('Usuario', 'crear');
                }
            } else {
                $_SESSION['error_datos'] = $errores;
                $this->redirect('Usuario', 'crear');
            }
        }
    }

    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $persona = new Persona;
            $persona->setId($id);

            $per = $persona->getOne();

            if ($per->rol != 'client') {
                $usuario = new Usuario;
                $usuario->setPersona($id);

                $usu = $usuario->getOne();
            }

            include_once 'views/usuario/crear.php';
        } else {
            $this->redirect('Usuario', 'gestion');
        }
    }

    public function edit()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];

            $persona = new Persona;

            $identifiacion = isset($_POST['identificacion']) ? mysqli_real_escape_string(
                $persona->getDb(),
                $_POST['identificacion']
            ) : false;
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($persona->getDb(), $_POST['nombre']) : false;
            $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($persona->getDb(), $_POST['apellido']) : false;
            $correo = isset($_POST['correo']) ? mysqli_real_escape_string($persona->getDb(), $_POST['correo']) : false;
            $rol = isset($_POST['rol']) ? mysqli_real_escape_string($persona->getDb(), $_POST['rol']) : false;

            $errores = array();

            if (!is_numeric($identifiacion) || !filter_var($identifiacion, FILTER_VALIDATE_INT)) {
                $errores['identificacion'] = 'Identificacion no valida';
            }
            if (!is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
                $errores['nombre'] = 'Nombre no valido';
            }
            if (!is_string($apellido) || preg_match("/[0-9]/", $apellido)) {
                $errores['apellido'] = 'Apellido no valido';
            }
            if (!is_string($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = 'Correo no valido';
            }
            if ($rol == 0) {
                $errores['rol'] = 'Seleccion un rol';
            }

            $persona->setIdentificacion($identifiacion);
            $persona->setNombre($nombre);
            $persona->setApellido($apellido);
            $persona->setCorreo($correo);
            $persona->setRol($rol);

            $persona->setId($id);
            $edit = $persona->edit();

            if ($edit) {
                $_SESSION['edit'] = 'complete';
                $this->redirect('Usuario', 'gestion');
            } else {
                $_SESSION['edit'] = 'failed';
                $this->redirect('Usuario', 'editar');
            }
        } else {
            $this->redirect('Usuario', 'crear');
        }
    }

    public function login()
    {
        if (isset($_POST)) {
            /* identificar usuario */
            $usuario = new Usuario;
            $usuario->setUsuario($_POST['usuario']);
            $usuario->setContrasenia($_POST['contrasenia']);
            $identity = $usuario->login();

            /* crear session */
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                } elseif ($identity->rol == 'secret') {
                    $_SESSION['secret'] = true;
                }
                header('location: ' . base_url . 'Admin/index');
            } else {
                $_SESSION['error_login'] = 'Identificacion fallida';
                $this->redirect('Template', 'login');
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        if (isset($_SESSION['secret'])) {
            unset($_SESSION['secret']);
        }
        $this->redirect('Auth', 'login');
    }
}
