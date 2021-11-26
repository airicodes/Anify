<?php

namespace app\controllers;

class User extends \app\core\Controller {

    // go to regular index
    public function regularIndex() {
        $this->view("Regular/index");
    }

    public function adminIndex() {
        $this->view("Admin/index");
    }
}