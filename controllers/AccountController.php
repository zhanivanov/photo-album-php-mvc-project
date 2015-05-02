<?php

class AccountController extends BaseController {
    private $db;

    public function onInit(){
        $this->accountsModel = new AccountModel();
    }

    public function register(){
        if($this->isPost()) {
            $username = $_POST['username'];
            if($username == null || strlen($username) < 3) {
                $_SESSION['error'] = array("Username is invalid. Must be more than 3 characters.");
                $this->redirect("account", "register");
            }
            $password = $_POST['password'];
            if($password == null || strlen($password) < 3) {
                $_SESSION['error'] = array("Password is invalid. Must be more than 3 characters.");
                $this->redirect("account", "register");
            }
            $confirmPassword = $_POST['confirmPassword'];
            $name = $_POST['name'];
            if($password != $confirmPassword){
                $_SESSION['error'] = array("Passwords are not matching.");
            } else {
                $isRegistered = $this->accountsModel->register($username, $password, $name);
                if($isRegistered){
                    $_SESSION['username'] = $username;
                    $_SESSION['userId'] = $this->accountsModel->getUserId($username);
                    $_SESSION['success'] = array("Successful registration!");
                    $this->redirect("albums");
                } else {
                    $_SESSION['error'] = array("Register failed!");
                }
            }
        }
        if($this->isLoggedIn()) {
            $this->redirect("home");
        } else{
            $this->renderView(__FUNCTION__);
        }
    }

    public function login() {
        if($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $isLogged = $this->accountsModel->login($username, $password);
            if($isLogged){
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $this->accountsModel->getUserId($username);
                $_SESSION['success']= array("Successful login!");
                $this->redirect("albums");
            } else {
                $_SESSION['error']= array("Login failed");
            }
        }

        if($this->isLoggedIn()) {
            $this->redirect("home");
        } else{
            $this->renderView(__FUNCTION__);
        }
    }

    public function logout() {
        unset($_SESSION['username']);
        $_SESSION['info']= array("Successful logout!");
        $this->redirect("home");
    }
}