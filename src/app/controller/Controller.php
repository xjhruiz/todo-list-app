<?php

use Firebase\JWT\JWT;

class Controller
{
    private $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function init()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['token']) || !isset($_COOKIE['token'])) {
            require __DIR__ . '../../view/init.php';
        } else {
            $params['listTask'] = $this->model->listTask('tasks');
            $params['listGroups'] = $this->model->listTask('groups');
            $params['listUsers'] = $this->model->listNombreIdUser();
            require __DIR__ . '../../view/home.php';
        }
    }

    public function login($request)
    {
        require_once __DIR__ . '../../../../php-jwt-master/src/JWT.php';
        if (isset($request['user']) && isset($request['password'])) {
            $userForm = $request['user'];
            $passForm = $request['password'];
            if ($data = $this->model->checkLogin($userForm, $passForm)) {
                $_SESSION['user'] = $data['nombre'];
                $_SESSION['name'] = $data['nombreUsuario'];
                $time = time();
                $key = "jhddertdededeurieroi5deded32";
                $token = array(
                    'ait' => $time,
                    'exp' => $time + (60 * 60 * 2),
                    'user' => $data['nombreUsuario'],
                    'idUser' => $data['id']
                );
                $jwt = JWT::encode($token, $key);
                $jwtDecode = JWT::decode($jwt, $key, array('HS256'));
                $_SESSION['dataToken'] = $jwtDecode;
                $_SESSION['token'] = $jwt;
                setcookie("token", $jwt, time() + (60 * 60 * 2), "/");
                setcookie("user", $data['nombreUsuario'], time() + (60 * 60 * 2));
                header("location: /");
            } else {
                setcookie("token", "", time() - 1, "/");
                setcookie("user", "", time() - 1, "/");
                $errorLogin = "Nombre de usuario y/o password incorrecto";
                require __DIR__ . '../../view/init.php';
            }
        } else {
            require __DIR__ . '../../view/init.php';
        }
    }

    public function logout()
    {
        setcookie("token", "", time() - 1, "/");
        setcookie("user", "", time() - 1, "/");
        session_unset();
        session_destroy();
        $_SESSION = [];
        header("location: /");
    }
}
