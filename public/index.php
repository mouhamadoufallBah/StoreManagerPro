<?php
define("BASEPATH", dirname(__DIR__));
require_once(BASEPATH."/vendor/autoload.php");
use StoreManagerPro\Src\Core\Router;

$router = new Router();

$router->redirection();

