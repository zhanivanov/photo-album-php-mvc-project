<?php

class AccountController extends BaseController {
    private $db;

    public function onInit(){
        $this->accountsModel = new AccountModel();
    }

    public function register(){
        if($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $name = $_POST['name'];
            if($password != $confirmPassword){
                $this->addErrorMessage("Passwords are not matching.");
            } else {
                $isRegistered = $this->accountsModel->register($username, $password, $name);
                if($isRegistered){
                    $this->redirect("albums");
                } else {
                    $this->addErrorMessage("Register failed");
                }
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login($username, $password) {

    }

    public function logout() {

    }
}