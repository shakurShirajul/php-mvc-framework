<?php

namespace Controllers;

use Controller;
use Models\UserModel;



class UserControllers extends Controller
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function users()
    {
        $user = $this->userModel->all();
        $this->response->sendStatus(200);
        $this->response->setContent($user);
    }
    public function user($params = [])
    {
        $id = $params['id'] ?? null;

        if ($id === null) {
            $this->response->sendStatus(400);
            return;
        }

        $user = $this->userModel->findOne($id);
        $this->response->sendStatus(200);
        $this->response->setContent($user);
    }
}
