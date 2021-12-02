<?php

namespace app\controllers;

#[\app\filters\MainPage]
class Profile extends \app\core\Controller {

    public $folder='uploads/';

    // method to create profile when user first logs in.
    // the filter checks if a profile was already created.
    #[\app\filters\ProfileAlreadyCreated]
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

    // method that is called whenever the edit profile button is pressed on any screen.
    public function editProfileButton() {
        if ($_SESSION["role"] == "admin") {
            header("location:".BASE."Profile/adminEditProfile");
        } else if ($_SESSION["role"] == "regular") {
            header("location:".BASE."Profile/regularEditProfile");
        }
    }

    // method to enter the edit profile page for admins.
    #[\app\filters\Regular]
    public function adminEditProfile() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        // this if statement is to view a preview of the profile picture
        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Profile/adminEditProfile', ['error'=>"No image was selected",'image'=> "/uploads/defaultAvatar.png", "user" => $user, "profile" => $profile]);
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
                    $this->view('Profile/adminEditProfile', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Profile/adminEditProfile', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $profile->filename = "/".$this->folder.$filename;
                    $this->view("Profile/adminEditProfile", ["error"=>"", "user" => $user, "profile" => $profile]);
                } else {
                    $this->view("Profile/adminEditProfile", ["error"=>"Cant upload", "user" => $user, "profile" => $profile]);
                }
            }

            return;
        }

        // code for when save changes is pressed.
        if (isset($_POST["action"])) {
            $newUsername = trim($_POST["newUsername"]);
            $newBio = trim($_POST["newBio"]);

            if (strlen($newUsername) > 14) {
                $this->view("Profile/adminEditProfile", ["error" => "Maximum username length is 20 characters", "user" => $user, "profile" => $profile]);
                return;
            }

            // checking if username is empty, and checking if the username change does not exist.
            if (empty($newUsername)) {
                $this->view("Profile/adminEditProfile", ["error" => "Username cannot be empty", "user" => $user, "profile" => $profile]);
                return;
            } else if (!($newUsername == $user->username)) {
                $allUsers = $user->getAllUsers();
                foreach ($allUsers as $currentUser) {
                    if (strtolower($currentUser->username) == strtolower($newUsername)) {
                        $this->view("Profile/adminEditProfile", ["error" => "This username already exists", "user" => $user, "profile" => $profile]);
                        return;
                    }
                }
            }

            if ($_FILES["newPicture"]["size"] < 1 && empty(trim($_POST["newBio"]))) {
                $profile->bio = "No bio yet...";
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/adminIndex");
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
                    $this->view('Profile/adminEditProfile', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Profile/adminEditProfile', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
                    return;
                }
                if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
                    $profile->filename = "/".$this->folder.$filename;
                    if (empty(trim($_POST["newBio"]))) {
                        $profile->bio = "No bio yet...";
                    } else {
                        $profile->bio = $_POST["newBio"];
                    }
                    $profile->updateProfile();
                    $user->username = $_POST["newUsername"];
                    $user->updateUsername();
                    header("location:".BASE."User/adminIndex");
                    return;
                } else {
                    $this->view("Profile/adminEditProfile", ["error"=>"I am not able to upload the image... sorry.", "user" => $user, "profile" => $profile]);
                }
            } else if ($_FILES["newPicture"]["size"] < 1 && !empty(trim($_POST["newBio"]))) {
                $profile->bio = $_POST["newBio"];
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/adminIndex");
            }

            return;
        }

        $this->view("Profile/adminEditProfile", ["user" => $user, "profile" => $profile, "error" => ""]);
    }

    // method to enter the page where a user can edit their profile.
    #[\app\filters\Admin]
    public function regularEditProfile() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        // this if statement is to view a preview of the profile picture
        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Profile/regularEditProfile', ['error'=>"No image was selected",'image'=> "/uploads/defaultAvatar.png", "user" => $user, "profile" => $profile]);
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
                    $this->view('Profile/regularEditProfile', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Profile/regularEditProfile', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $profile->filename = "/".$this->folder.$filename;
                    $this->view("Profile/regularEditProfile", ["error"=>"", "user" => $user, "profile" => $profile]);
                } else {
                    $this->view("Profile/regularEditProfile", ["error"=>"Cant upload", "user" => $user, "profile" => $profile]);
                }
            }

            return;
        }

        // code for when save changes is pressed.
        if (isset($_POST["action"])) {
            $newUsername = trim($_POST["newUsername"]);
            $newBio = trim($_POST["newBio"]);

            if (strlen($newUsername) > 14) {
                $this->view("Profile/regularEditProfile", ["error" => "Maximum username length is 20 characters", "user" => $user, "profile" => $profile]);
                return;
            }

            // checking if username is empty, and checking if the username change does not exist.
            if (empty($newUsername)) {
                $this->view("Profile/regularEditProfile", ["error" => "Username cannot be empty", "user" => $user, "profile" => $profile]);
                return;
            } else if (!($newUsername == $user->username)) {
                $allUsers = $user->getAllUsers();
                foreach ($allUsers as $currentUser) {
                    if (strtolower($currentUser->username) == strtolower($newUsername)) {
                        $this->view("Profile/regularEditProfile", ["error" => "This username already exists", "user" => $user, "profile" => $profile]);
                        return;
                    }
                }
            }

            if ($_FILES["newPicture"]["size"] < 1 && empty(trim($_POST["newBio"]))) {
                $profile->bio = "No bio yet...";
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/regularIndex");
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
                    $this->view('Profile/regularEditProfile', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Profile/regularEditProfile', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
                    return;
                }
                if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
                    $profile->filename = "/".$this->folder.$filename;
                    if (empty(trim($_POST["newBio"]))) {
                        $profile->bio = "No bio yet...";
                    } else {
                        $profile->bio = $_POST["newBio"];
                    }
                    $profile->updateProfile();
                    $user->username = $_POST["newUsername"];
                    $user->updateUsername();
                    header("location:".BASE."User/regularIndex");
                    return;
                } else {
                    $this->view("Profile/regularEditProfile", ["error"=>"I am not able to upload the image... sorry.", "user" => $user, "profile" => $profile]);
                }
            } else if ($_FILES["newPicture"]["size"] < 1 && !empty(trim($_POST["newBio"]))) {
                $profile->bio = $_POST["newBio"];
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/regularIndex");
            }

            return;
        }

        $this->view("Profile/regularEditProfile", ["user" => $user, "profile" => $profile, "error" => ""]);
    }
}