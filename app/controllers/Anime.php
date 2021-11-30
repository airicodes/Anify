<?php

namespace app\controllers;

class Anime extends \app\core\Controller {

    public $folder='uploads/';

    #[\app\filters\Regular]
    public function addAnime() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Anime/addAnime', ['error'=>"No image was selected",'image'=> null, "user" => $user, "profile" => $profile]);
                return;
            }
            if(isset($_FILES['newPicture'])){
                $check = getimagesize($_FILES['newPicture']['tmp_name']);

                $mime_type_to_extension = ['image/jpeg'=>'.jpg',
                                            'image/gif'=>'.gif',
                                            'image/bmp'=>'.bmp',
                                            'image/png'=>'.png'
                                            ];

                if($check !== false && isset($mime_type_to_extension[$check['mime']])){
                    $extension = $mime_type_to_extension[$check['mime']];
                }else{
                    $this->view('Anime/addAnime', ['error'=>"Bad file type",'image'=> null, "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Anime/addAnime', ['error'=>"File too large", 'image'=>null, "user" => $user, "profile" => $profile]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $this->view("Anime/addAnime", ["error"=>"", "image" => "/".$this->folder.$filename, "user" => $user, "profile" => $profile]);
                } else {
                    $this->view("Anime/addAnime", ["error"=>"Can't upload", "image" => null, "user" => $user, "profile" => $profile]);
                }
            }

            return;
        }

        if (isset($_POST["cancel"])) {
            header("location:".BASE."User/adminIndex");
            return;
        }

        if (isset($_POST["confirm"])) {

        }



        $this->view("Anime/addAnime", ["error" => "", "image" => "/uploads/Rectangle_157.png", "user" => $user, "profile" => $profile]);
    }
}