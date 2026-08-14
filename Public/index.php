<?php

use Src\Core\Database;

define("BASEPATH", dirname(__DIR__));
require_once(BASEPATH."/vendor/autoload.php");

$db = Database::getInstance();

var_dump($db->getAttribute(PDO::ATTR_DRIVER_NAME));

