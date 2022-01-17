<?php
require_once 'ErrorController.php';
class TemplateController
{
    public function ctrTemplate()
    {
        /* if ($_SESSION == 'user') { */
            include_once 'views/template.php';
        /* } else {
            include_once 'views/auth/inicio.php';
        } */
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
                $action_default = action_default;
                $controlador->$action_default();
            } else {
                $this->showError();
            }
        } else {
            $this->showError();
        }
    }
}
