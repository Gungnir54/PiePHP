<?php

namespace Core;

class Request {

    public $requestPost = [];
    public $requestGet = [];

    public function __construct() {
        if($_POST) {
            foreach($_POST as $key => $value) {
                $this->requestPost[$key] = stripslashes($value);
                $this->requestPost[$key] = htmlspecialchars($value);
                $this->requestPost[$key] = trim($value);
            }
        }

        if($_GET) {
            foreach($_GET as $key => $value) {
                $this->requestGet[$key] = stripslashes($value);
                $this->requestGet[$key] = htmlspecialchars($value);
                $this->requestGet[$key] = trim($value);
            }
        }
    }
}
