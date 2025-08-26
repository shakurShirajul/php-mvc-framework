<?php


class Controller
{
    public $response, $request;
    public function __construct()
    {
        $this->response = $GLOBALS["response"];
        $this->request = $GLOBALS['request'];
    }
    public function model($model)
    {
        $file = MODELS . ucfirst($model) . ".php";
        if (file_exists($file)) {
            require_once $file;
            if (class_exists($model)) {
                return new $model;
            }
        }
    }
}
