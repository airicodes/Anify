<?php

namespace app\controllers;

#[\app\filters\Login]
#[\app\filters\ProfileAlreadyCreated]
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

            $profile = new \app\models\Profile();
            if ($_FILES["newPicture"]["size"] < 1 && empty(trim($_POST["bio"]))) {
                $profile->user_id = $_SESSION["user_id"];
                $profile->bio = "No bio yet...";
                $profile->filename = "/uploads/defaultAvatar.png";
                $profile->insertProfile();
                if ($_SESSION["role"] == "admin") {
                    header("location:".BASE."User/adminIndex");
                } else if ($_SESSION["role"] == "regular") {
                    header("location:".BASE."User/regularIndex");
                }
            } else if ($_FILES['newPicture']["size"] > 0) {
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

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Profile/profile', ['error'=>"File too large",'image'=>null]);
                    return;
                }
                if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
                    $profile->user_id = $_SESSION["user_id"];
                    $profile->filename = "/".$this->folder.$filename;
                    if (empty(trim($_POST["bio"]))) {
                        $profile->bio = "No bio yet...";
                    } else {
                        $profile->bio = $_POST["bio"];
                    }
                    $profile->insertProfile();
                    if ($_SESSION["role"] == "admin") {
                        header("location:".BASE."User/adminIndex");
                    } else if ($_SESSION["role"] == "regular") {
                        header("location:".BASE."User/regularIndex");
                    }
                } else {
                    $this->view("Profile/profile", ["error"=>"I am not able to upload the image... sorry.", "image" => null]);
                }
            } else if ($_FILES["newPicture"]["size"] < 1 && !empty(trim($_POST["bio"]))) {
                $profile->user_id = $_SESSION["user_id"];
                $profile->bio = $_POST["bio"];
                $profile->filename = "/uploads/defaultAvatar.png";
                $profile->insertProfile();
                if ($_SESSION["role"] == "admin") {
                    header("location:".BASE."User/adminIndex");
                } else if ($_SESSION["role"] == "regular") {
                    header("location:".BASE."User/regularIndex");
                }
            }

        } else {
            $this->view("Profile/profile", ["error" => "", "image" => "/uploads/defaultAvatar.png"]);
        }
    }
}