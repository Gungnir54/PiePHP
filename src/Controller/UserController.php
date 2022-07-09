<?php

namespace Controller;

class UserController extends \Core\Controller {

    function __construct() {
        echo "<br>";
        echo "Je suis dans le UserController";
        echo '<br>';
        $this->requestParams = new \Core\Request;
    }

    public function indexAction() {
        echo __METHOD__."[OK]".PHP_EOL;
    }

    public function addAction() {
        $this->render('register');
    }

    public function registerAction() {
        $params = array('email' => $this->requestParams->requestPost['email'], 'password' => $this->requestParams->requestPost['password']);
        $userModel = new \Model\UserModel($params);
        $userModel->save();
        header('Location:'.$this->render('index'));
    }

    public function logAction() {
        $this->render('login');
    }

    public function loginAction() {
        $params = array('email' => $this->requestParams->requestPost['email'], 'password' => $this->requestParams->requestPost['password']);
        $userModel = new \Model\UserModel($params);
        $userModel->login();
        header('Location:'.$this->render('index'));
    }

    public function userPageAction() {
        $this->render('index');
    }

    public function readAction() {
        $params = array('id' => $this->requestParams->requestPost['id']);
        $userModel = new \Model\UserModel($params);
        $infoUser = $userModel->infoUser();
        return $infoUser;
    }

    public function disconnectAction() {
        $params = array('id' => $this->requestParams->requestPost['id']);
        $userModel = new \Model\UserModel($params);
        $userModel->unsetCookie();
        header('Location:'.$this->render('login'));
    }

    public function upDAction() {
        $this->render('update');
    }

    public function updateAction() {
        $params = array('id' => $this->requestParams->requestPost['id'], 'email' => $this->requestParams->requestPost['email'], 'password' => $this->requestParams->requestPost['password']);
        $userModel = new \Model\UserModel($params);
        $userModel->updateInfo();
    }

    public function deleteAction() {
        $params = array('id' => $this->requestParams->requestPost['id']);
        $userModel = new \Model\UserModel($params);
        $userModel->deleteUser();
        $userModel->unsetCookie();
        header('Location:'.$this->render('register'));
    }
}
