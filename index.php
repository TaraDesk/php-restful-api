<?php

require_once __DIR__ . '/src/utils/error_handler.php';
require_once __DIR__ . '/src/utils/validator.php';

require_once __DIR__ . '/src/config/credentials.php';
require_once __DIR__ . '/src/config/Database.php';

require_once __DIR__ . '/src/QuizController.php';
require_once __DIR__ . '/src/QuizGateway.php';

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$database = new Database($db_host, $db_name, $db_user, $db_pass);
$gateway = new QuizGateway($database);
$validator = new Validator($gateway);
$controller = new QuizController($gateway, $validator);

$controller->handleRequest();

?>
