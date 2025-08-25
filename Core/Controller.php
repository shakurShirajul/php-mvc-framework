<?php


class Controller
{
    public $response;
    public function __construct()
    {
        $this->response = $GLOBALS["response"];
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
