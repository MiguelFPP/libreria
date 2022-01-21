<?php
require_once 'ErrorController.php';
class TemplateController
{
    public function ctrTemplate()
    {
        /* if (isset($_SESSION['identity']) && $_SESSION['identity'] = $idenity) { */
        include_once 'views/template.php';
        /* } else {
            $this->login();
        } */
    }

    function login()
    {
        include_once 'views/auth/inicio.php';
    }

    public function showError()
    {
        $error = new ErrorController();
        $error->index();
    }

    public function main()
    {
        if (isset($_GET['controller'])) {
            $nombre_controlador = $_GET['controller'] . 'Controller';
        } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $nombre_controlador = controller_default;
        } else {
            $this->showError();
            exit();
        }

        if (isset($nombre_controlador)) {
            $controlador = new $nombre_controlador();

            if (isset($_GET['action']) &&  method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action();
            } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
                $view_default = view_default;
                if (isset($_SESSION['identity'])) {
                    $controlador->$view_default();
                } else {
                    $this->login();
                }
            } else {
                $this->showError();
            }
        } else {
            $this->showError();
        }
    }
}
