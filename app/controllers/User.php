<?php

namespace app\controllers;

class User extends \app\core\Controller {

    // go to regular index
    public function regularIndex() {
        $this->view("User/regularIndex");
    }

    public function adminIndex() {
        $this->view("User/adminIndex");
    }

    public function profile() {
        $this->view("Profile/profile");
    }

    public function adminSettings() {
        $this->view("User/adminSettings");
    }
    
    public function regularSettings() {
        $this->view("User/regularSettings");
    }

    public function settings() {
        $this->view("User/settings");
    }

    public function adminAbout() {
        $this->view("User/adminAbout");        
    }

    public function regularAbout() {
        $this->view("User/regularAbout");
    }
}