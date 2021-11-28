<?php

namespace app\controllers;

#[\app\filters\Login]
#[\app\filters\ProfileCheck]
class User extends \app\core\Controller {

    // go to admin index.
    // we are getting the user so that we have the username, and we are getting the profile for pfp and bio.
    #[\app\filters\Regular]
    public function adminIndex() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);


        $this->view("User/adminIndex", ["user" => $user, "profile" => $profile]);
    }

    // go to regular index
    #[\app\filters\Admin]
    public function regularIndex() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/regularIndex", ["user" => $user, "profile" => $profile]);
    }

    #[\app\filters\Regular]
    public function adminSettings() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/adminSettings", ["user" => $user, "profile" => $profile]);
    }
    
    #[\app\filters\Admin]
    public function regularSettings() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/regularSettings", ["user" => $user, "profile" => $profile]);
    }

    #[\app\filters\Regular]
    public function adminAbout() {
        $this->view("User/adminAbout");        
    }

    #[\app\filters\Admin]
    public function regularAbout() {
        $this->view("User/regularAbout");
    }
}