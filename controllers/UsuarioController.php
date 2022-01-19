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
                    $contraseniaEn = md5($identifiacion);
                    $usuario->setUsuario($correo);
                    $usuario->setContrasenia($contraseniaEn);
                    $usuario->setPersona($persona_id);

                    $save = $usuario->save();
                }

                if ($save) {
                    $_SESSION['register'] = 'complete';
                    $this->redirect('usuario', 'gestion');
                } else {
                    $_SESSION['register'] = 'failed';
                    $this->redirect('usuario', 'crear');
                }
            } else {
                $_SESSION['errores_datos'] = $errores;
                $this->redirect('usuario', 'crear');
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
            $this->redirect('usuario', 'gestion');
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
                $this->redirect('usuario', 'gestion');
            } else {
                $_SESSION['edit'] = 'failed';
                $this->redirect('usuario', 'editar');
            }
        } else {
            $this->redirect('usuario', 'crear');
        }
    }
}
