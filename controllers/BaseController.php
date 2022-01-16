<?php
class BaseController
{
    public function redirect($controlador, $action)
    {
        /* header('location:' . base_url . $controlador . '/' . $action); */
        echo "<script>window.location.href = '$controlador/$action'</script>";
    }
}
