<?php

class Request
{
    public $request, $files, $cookie;
    public function __construct()
    {
        $this->request = $_REQUEST;
    }
    public function get($key)
    {
        if ($key != '') {
            return isset($_GET[$key]) ? $this->clean($_GET[$key]) : null;
        }
        return $this->clean($_GET);
    }
    public function post($key = '')
    {
        if ($key != '') {
            return isset($_POST[$key]) ? $this->clean($_POST[$key]) : null;
        }
        return $this->clean($_POST);
    }

    public function input($key = '')
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        if ($key != '') {
            return isset($request[$key]) ? $this->clean($request[$key]) : null;
        }
        return $this->clean($request);
    }

    public function server(String $key = '')
    {
        return isset($_SERVER[strtoupper($key)]) ? $this->clean($_SERVER[strtoupper($key)]) : $this->clean($_SERVER);
    }

    public function getMethod()
    {
        return strtoupper($this->server('REQUEST_METHOD'));
    }

    public function getClientIp()
    {
        return $this->server('REMOTE_ADDR');
    }

    public function getUrl()
    {
        return $this->server('REQUEST_URI');
    }
    private function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[$this->clean($key)] =  $this->clean($value);
            }
        } else {
            // $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
            $data = strip_tags($data);
        }
        return $data;
    }
}
