<?php

class HomeController extends BaseController {
    protected function onInit() {
        if($this->isLoggedIn()){
            $this->redirect("albums");
        } else{
            $this->title = 'Welcome';
            $this->renderView();
        }
    }
}
