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
                $this->addErrorMessage("Username is invalid. Must be more than 3 characters.");
                $this->redirect("account", "register");
            }
            $password = $_POST['password'];
            if($password == null || strlen($password) < 3) {
                $this->addErrorMessage("Password is invalid. Must be more than 3 characters.");
                $this->redirect("account", "register");
            }
            $confirmPassword = $_POST['confirmPassword'];
            $name = $_POST['name'];
            if($password != $confirmPassword){
                $this->addErrorMessage("Passwords are not matching.");
            } else {
                $isRegistered = $this->accountsModel->register($username, $password, $name);
                if($isRegistered){
                    $_SESSION['username'] = $username;
                    $this->addInfoMessage("Successful registration!");
                    $this->redirect("albums");
                } else {
                    $this->addErrorMessage("Register failed");
                }
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login() {
        if($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $isLogged = $this->accountsModel->login($username, $password);
            if($isLogged){
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successful login!");
                $this->redirect("albums");
            } else {
                $this->addErrorMessage("Login failed");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function logout() {
        unset($_SESSION['username']);
        $this->addInfoMessage("Successful logout!");
        $this->redirect("home");
    }
}