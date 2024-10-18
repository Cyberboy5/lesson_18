<?php
USE App\App;
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'autoload.php';
include 'web.php';
include 'App/Helpers/Helpers.php';

$app = new App();
$app->run();

?>