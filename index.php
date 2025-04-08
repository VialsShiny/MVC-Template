<?php
session_start();
require 'vendor/autoload.php';

use App\router\Router;

ini_set('display_errors', 1);
include 'loadEnv.php';

$spawnElement = new Router();
$spawnElement->dispatch($_SERVER['REQUEST_URI']);