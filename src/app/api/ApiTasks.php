<?php

class ApiTasks
{
    private $model;
    public function __construct(Model $newModel)
    {
        $this->model = $newModel;
    }

    public function getTask()
    {
        header('Content-Type: application/json');
        $listTasks = array();
        $listTasks['listTask'] = array();
        $response = $this->model->listTask('tasks');
        if ($response != false) {
            array_push($listTasks['listTask'], $response);
            echo json_encode($listTasks);
        } else {
            echo json_encode(array('mensaje' => 'Error, There is no task'));
        }
    }

    public function checkTokenJTW()
    {
        if (!isset($_SESSION['token'])) {
            echo json_encode(array("mensaje" => 'ACCESO DENEGADO'));
            exit;
        }
        if (!isset($_COOKIE['token'])) {
            echo json_encode(array("mensaje" => 'ACCESO DENEGADO'));
            exit;
        }

        if ($_SESSION['token'] = !$_COOKIE['token']) {
            echo json_encode(array("mensaje" => 'ACCESO DENEGADO'));
            exit;
        }
    }

    public function addNewTask($dataTask)
    {
        header('Content-Type: application/json');
        $this->checkTokenJTW();
        if (
            is_null($dataTask->nombreTarea) || empty($dataTask->nombreTarea) ||
            is_null($dataTask->descTarea) || empty($dataTask->descTarea) ||
            is_null($dataTask->estadoTarea) || empty($dataTask->estadoTarea)
        ) {
            echo json_encode(array('mensaje' => ' Fiels empty'));
            return 0;
        }
        $insert =  $this->model->insertTask($dataTask->nombreTarea, $dataTask->descTarea, $dataTask->estadoTarea);
        $datos = array();
        if ($insert) {
            $datos = array(
                'mensaje' => 'Created',
                'datos' => array($dataTask->nombreTarea, $dataTask->descTarea, $dataTask->estadoTarea)
            );
        } else {
            $datos['mensaje'] = 'Error !!! Could not insert ';
        }
        echo  json_encode($datos);
    }

    public function deleteTask($requestData)
    {
        $this->checkTokenJTW();
        header('Content-Type: application/json');

        if (!isset($requestData->idTask)) {
            echo json_encode(array('mensaje' =>  'Se necesita una petición post y pasar por el body una propiedad con el nombre de idTask'));
            return 0;
        }
        if (is_null($requestData->idTask) || empty($requestData->idTask)) {
            echo json_encode(array('mensaje' => ' Fiels empty'));
            return 0;
        }
        $eliminado = $this->model->deleteTask($requestData->idTask);

        if ($eliminado) {
            echo   json_encode(array(
                'mensaje' => 'Deleted',
            ));
        } else {
            echo json_encode(array('mensaje' => 'Error !!! Could not delete '));
        }
    }

    public function changeStatusTask($requestData)
    {
        $this->checkTokenJTW();
        header('Content-Type: application/json');

        if (!isset($requestData->idTask) || !isset($requestData->statusTask)) {
            echo json_encode(array('mensaje' =>  'Se necesita una petición post y pasar por el body una propiedad con el nombre de idTask y statusTask'));
            return 0;
        }
        if (
            is_null($requestData->idTask) || empty($requestData->idTask)
            || is_null($requestData->statusTask) || empty($requestData->statusTask)
        ) {
            echo json_encode(array('mensaje' => 'Fiels empty'));
            return 0;
        }
        $actualizado = $this->model->updateStatuTask($requestData->statusTask, $requestData->idTask);

        if ($actualizado) {
            echo   json_encode(array(
                'mensaje' => 'Changed'
            ));
        } else {
            echo json_encode(array('mensaje' => 'Error !!! Could not Change status '));
        }
    }
}
