<?php

namespace app\controllers;

class Anime extends \app\core\Controller {

    #[\app\filters\Regular]
    public function addAnime() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("Anime/addAnime", ["user" => $user, "profile" => $profile]);
    }
}