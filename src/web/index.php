<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once __DIR__ . '../../app/model/Config.php';
require_once __DIR__ . '../../app/model/Model.php';
require_once __DIR__ . '../../app/api/ApiTasks.php';
require_once __DIR__ . '../../app/controller/Controller.php';



ini_set('display_errors', 1);
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);

session_start();

$url      = strtok($_SERVER['REQUEST_URI'], '?');
$urlPath  = explode('/', $url)[1];
$response = '';
$request  = array_merge($_REQUEST, ['REQUEST_URL' => $url, 'REQUEST_URL_PATH' => $urlPath]);

$controler = new Controller(new Model);
$apiTask = new ApiTasks(new Model);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($url) {
        case '/login':
            $controler->login($request);
            break;
        case '/task':
            $_POST = json_decode(file_get_contents('php://input'));
            $apiTask->addNewTask($_POST);
            break;
        case '/deleteTask':
            $_POST = json_decode(file_get_contents('php://input'));
            $apiTask->deleteTask($_POST);
            break;
        case '/changeStatus':
            $_POST = json_decode(file_get_contents('php://input'));
            $apiTask->changeStatusTask($_POST);
            break;
        default:
            $response = "Error, the POST $url doesn't exist!";
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($url) {
        case '':
        case '/':
        case '/login':
        case '/task':
            $controler->init();
            break;
        case '/logout':
            $controler->logout($request);
            break;
        case '/getTask';
            $apiTask->getTask();
            break;
        default:
            echo "Error, the request GET $url doesn't exist! ";
            // http_response_code(404);
            break;
    }
}
