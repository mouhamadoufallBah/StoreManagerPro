<?php
define("BASEPATH", dirname(__DIR__));
require_once(BASEPATH."/vendor/autoload.php");

use StoreManagerPro\Src\Core\Database;
use StoreManagerPro\Src\Core\Router;
use StoreManagerPro\Src\Core\SessionManager;

SessionManager::getInstance();
$router = new Router();
Database::getInstance();
$router->redirection();

