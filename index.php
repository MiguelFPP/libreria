<?php
/* ob_start(); */
session_start();
require_once 'autoload.php';
require_once 'config/database.php';
require_once 'config/parameters.php';
require_once 'helpers/Utils.php';
require_once 'controllers/TemplateController.php';

$template = new TemplateController();
$template->ctrTemplate();
/* ob_end_flush(); */