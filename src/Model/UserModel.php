<?php

namespace Model;

class UserModel extends \Core\Entity {

    public function __construct($params) {
        parent::__construct($params);
        $this->orm = new \Core\ORM;
    }

    public function save() {
        $fields = array("email" => $this->email, "password" => $this->password);
        $setCookie = $this->orm->create("user", $fields);
        setcookie('user', $setCookie, time() + 86400);
    }

    public function login() {
        $params = array("WHERE" => "email = '".$this->email."' AND password = '".$this->password."'");
        $cookie = $this->orm->find('user', $params);
        setcookie('user', $cookie['id'], time() + 86400);
    }

    public function infoUser() {
        $infoUser = $this->orm->read('user', $_COOKIE['user']);
        return $infoUser;
    }

    public function updateInfo() {
        if (!empty($_POST)) {
            $fields = array("email" => $this->email, "password" => $this->password);
            $this->orm->update('user', $_COOKIE['user'], $fields);
        }
    }

    public function deleteUser() {
        $this->orm->delete('user', $_COOKIE['user']);
    }

    public function unsetCookie() {
        setcookie('user', $_COOKIE['user'], time() - 86400);
    }
}
