<?php

namespace app\controllers;

class Profile extends \app\core\Controller {

    public $folder='uploads/';

    public function profile() {

        // this if statement is to view a preview of the profile picture
        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Profile/profile', ['error'=>"No image was selected",'image'=> "/uploads/defaultAvatar.png"]);
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
                    $this->view('Profile/profile', ['error'=>"Bad file type",'image'=> null]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Profile/profile', ['error'=>"File too large",'image'=>null]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $this->view("Profile/profile", ["error"=>"", "image" => "/".$this->folder.$filename]);
                } else {
                    $this->view("Profile/profile", ["error"=>"Cant upload", "image" => null]);
                }
            }

            return;
        }

        if (isset($_POST["action"])) {
            
        } else {
            $this->view("Profile/profile", ["error" => "", "image" => "/uploads/defaultAvatar.png"]);
        }



    }
}