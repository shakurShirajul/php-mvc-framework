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
    public function store()
    {
        $data =  $this->request->input();
        $user = $this->userModel->createOne($data);
        echo json_encode($user);
    }
    public function update()
    {
        $data = $this->request->input();
        $user = $this->userModel->updateOne($data);
        echo json_encode($user);
    }
    public function destroy()
    {
        try {
            $id = $this->request->input('id');
            if ($id === null) {
                $this->response->sendStatus(400);
                $this->response->setContent('ID Not Found!');
            }
            $result = $this->userModel->deleteOne($id);
            echo json_encode($result);
        } catch (\Exception $e) {
            $this->response->sendStatus(500);
            $this->response->setContent($e->getMessage());
        }
    }
}
