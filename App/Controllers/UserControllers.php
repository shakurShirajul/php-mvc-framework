<?php

namespace Controllers;

use Controller;
use Models\UserModel;



class UserControllers extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function users()
    {
        // $model = $this->model('UserModel');
        // $user = $model->getAllUser();
        // echo json_encode($user);
        $user = $this->userModel->all();
        echo json_encode($user);
        $this->response->sendStatus(200);
        $this->response->setContent($user);
    }
    public function user()
    {

        $user = $this->userModel->findOne($_GET["id"]);
        echo json_encode($user);
    }
}
