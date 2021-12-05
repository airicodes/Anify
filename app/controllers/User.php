<?php

namespace app\controllers;

use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

#[\app\filters\MainPage]
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

        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($_SESSION["user_id"]);
        if(isset($_POST["submitPost"])) {
            $post = trim($_POST["userPost"]);
            if (empty($post)) {
                $this->view("User/adminIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"Nothing was entered"]);
                return;
            } 
            if (strlen($post) > 140) {
                $this->view("User/adminIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"Text must be 140 characters max"]);
                return;
            }
            $profilePost->post = $post;
            $profilePost->date = date('Y-m-d H:i:s');
            $profilePost->user_id = $_SESSION["user_id"];
            $profilePost->addPost();
            header("location:".BASE."User/adminIndex");
        }


        $this->view("User/adminIndex", ["user" => $user, "profile" => $profile, "posts"=>$posts, "error"=>""]);
    }

    // go to regular index
    #[\app\filters\Admin]
    public function regularIndex() {

        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($_SESSION["user_id"]);

        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        if(isset($_POST["submitPost"])) {
            $post = trim($_POST["userPost"]);
            if (empty($post)) {
                $this->view("User/regularIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"Nothing was entered"]);
                return;
            } 
            if (strlen($post) > 140) {
                $this->view("User/regularIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"Text must be 140 characters max"]);
                return;
            }
            $profilePost->post = $post;
            $profilePost->date = date('Y-m-d H:i:s');
            $profilePost->user_id = $_SESSION["user_id"];
            $profilePost->addPost();
            header("location:".BASE."User/regularIndex");
        }


        $this->view("User/regularIndex", ["user" => $user, "profile" => $profile, "posts"=>$posts, "error"=>""]);
    }

    #[\app\filters\Regular]
    public function adminSettings() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        // code to change password.
        if (isset($_POST["action"])) {
            $oldPass = trim($_POST["oldPassword"]);
            $newPass = trim($_POST["newPassword"]);
            $confirmNewPass = trim($_POST["confirmNewPassword"]);

            // check if any textbox is empty
            if (empty($oldPass) || empty($newPass) || empty($confirmNewPass)) {
                $this->view("User/adminSettings", ["error" => "One or more fields are empty", "user" => $user, "profile" => $profile]);
                return;
            }

            if ($oldPass == $newPass) {
                $this->view("User/adminSettings", ["error" => "New password is the same as old password", "user" => $user, "profile" => $profile]);
                return;
            }

            if (password_verify($_POST["oldPassword"], $user->hash)) {
                if ($newPass == $confirmNewPass) {
                    $user->password = $newPass;
                    $user->updatePassword($_SESSION["user_id"]);
                    $_SESSION["passwordUpdate"] = "successful";
                    $this->view("User/adminSettings", ["error" => "", "user" => $user, "profile" => $profile]);
                } else {
                    $this->view("User/adminSettings", ["error" => "The new password and old password do not match...", "user" => $user, "profile" => $profile]);
                }
            } else {
                $this->view("User/adminSettings", ["error" => "Your old password is incorrect...", "user" => $user, "profile" => $profile]);
            }
        } else {
            $this->view("User/adminSettings", ["error" => "", "user" => $user, "profile" => $profile]);
        }

    }
    
    // method that brings the regular user to their settings page.
    #[\app\filters\Admin]
    public function regularSettings() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        // code to change password.
        if (isset($_POST["changePassword"])) {
            $oldPass = trim($_POST["oldPassword"]);
            $newPass = trim($_POST["newPassword"]);
            $confirmNewPass = trim($_POST["confirmNewPassword"]);

            if (empty($oldPass) || empty($newPass) || empty($confirmNewPass)) {
                $this->view("User/regularSettings", ["error" => "One or more fields are empty", "user" => $user, "profile" => $profile, "feedback" => ""]);
                return;
            }

            if ($oldPass == $newPass) {
                $this->view("User/regularSettings", ["error" => "New password is the same as old password", "user" => $user, "profile" => $profile, "feedback" => ""]);
                return;
            }

            // verify that old pass is equal to the hash in db.
            if (password_verify($_POST["oldPassword"], $user->hash)) {
                if ($newPass == $confirmNewPass) {
                    $user->password = $newPass;
                    $user->updatePassword($_SESSION["user_id"]);
                    $_SESSION["passwordUpdate"] = "successful";
                    $this->view("User/regularSettings", ["error" => "", "user" => $user, "profile" => $profile, "feedback" => ""]);
                } else {
                    $this->view("User/regularSettings", ["error" => "The new password and old password do not match...", "user" => $user, "profile" => $profile, "feedback" => ""]);
                }
            } else {
                $this->view("User/regularSettings", ["error" => "Your old password is incorrect...", "user" => $user, "profile" => $profile, "feedback" => ""]);
            }

            return;
        }

        $mail = new PHPMailer(true);

        // when the feedback send button is pressed, checks if empty or more than 300 characters.
        // if those are satisfied, the email is sent, and the user gets a popup.
        if (isset($_POST["feedback"])) {
            if (empty(trim($_POST["message"]))) {
                $this->view("User/regularSettings", ["error" => "", "user" => $user, "profile" => $profile, "feedback" => "Nothing was entered..."]);
                return;
            }
            if (strlen($_POST["message"]) > 300) {
                $this->view("User/regularSettings", ["error" => "", "user" => $user, "profile" => $profile, "feedback" => "The feedback is more than 300 characters long..."]);
                return;
            }
            $user = new \app\models\User();
            $user = $user->getUser($_SESSION["user_id"]);
            $feedback = $_POST["message"];

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "testingsysdev@gmail.com";
            $mail->Password = "Ilovesysdev123";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom("testingsysdev@gmail.com");
            $mail->addAddress("testingsysdev@gmail.com");
 
            $mail->isHTML(true);
            $mail->Subject = ("Feedback");
            $mail->Body = "<h3>Name: $user->username <br>Feedback: $feedback</h3>";

            $mail->send();

            $_SESSION["feedbackSent"] = "sent";
        } 

        $this->view("User/regularSettings", ["error" => "", "user" => $user, "profile" => $profile, "feedback" => ""]);
    }

    // method to display the admin about page.
    #[\app\filters\Regular]
    public function adminAbout() {
        $this->view("User/adminAbout");        
    }

    // method to display the regular about page.
    #[\app\filters\Admin]
    public function regularAbout() {
        $this->view("User/regularAbout");
    }

    // Method that is called whenever the delete account button is pressed on any screen.
    public function deleteAccountButton() {
        if ($_SESSION["role"] == "admin") {
            header("location:".BASE."User/adminDeleteAccount");
        } else if ($_SESSION["role"] == "regular") {
            header("location:".BASE."User/regularDeleteAccount");
        }
    }

    // method to delete an admin account
    #[\app\filters\Regular]
    public function adminDeleteAccount() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);

        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($_SESSION["user_id"]);
        
        // if cancel is pressed, user is sent back to their index page.
        if (isset($_POST["cancel"])) {

            $profile = new \app\models\Profile();
            $profile = $profile->getProfile($_SESSION["user_id"]);

            $this->view("User/adminIndex", ["user" => $user, "profile" => $profile, "posts" => $posts, "error" => ""]);
            return;
        }

        // if delete account button clicked, the user is delete and sent back to login page.
        if (isset($_POST["delete"])) {
            $user->deleteUser();
            session_destroy();
            session_start();
            $_SESSION["deletedUser"] = "deleted";
            header("location:".BASE."Main/login");
            return;
        }

        $this->view("User/adminDeleteAccount");
    }

    // method to delete a regular user's account
    #[\app\filters\Admin]
    public function regularDeleteAccount() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);

        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($_SESSION["user_id"]);
        
        if (isset($_POST["cancel"])) {

            $profile = new \app\models\Profile();
            $profile = $profile->getProfile($_SESSION["user_id"]);

            $this->view("User/regularIndex", ["user" => $user, "profile" => $profile, "error" => "", "posts" => $posts]);
            return;
        }

        if (isset($_POST["delete"])) {
            $user->deleteUser();
            session_destroy();
            session_start();
            $_SESSION["deletedUser"] = "deleted";
            header("location:".BASE."Main/login");
            return;
        }

        $this->view("User/regularDeleteAccount");
    }

    // method to go to the admin's anime list page
    #[\app\filters\Regular]
    public function adminAnimeList() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/adminAnimeList", ["user" => $user, "profile" => $profile]);
    }

    // method to go to the regular user's anime list page
    #[\app\filters\Admin]
    public function regularAnimeList() {
        $anime = new \app\models\Anime();
        $animelist = new \app\models\Animelist();
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $animelist = $animelist->getUserAL($_SESSION['user_id']);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $allAnimeFromList = $anime->getAllAnimeFromList($animelist->animelist_id);
        $allFavAnimeFromList = $anime->getAllFavAnimeFromList($animelist->animelist_id);

        $this->view("User/regularAnimeList", ["user" => $user, "profile" => $profile, "list"=> $allAnimeFromList,
    "favlist" => $allFavAnimeFromList]);
    }

    // method to go to the admin's messages page.
    #[\app\filters\Regular]
    public function adminMessages() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/adminMessages", ["user" => $user, "profile" => $profile]);
    }

    // method to go to the regular user's messages page.
    #[\app\filters\Admin]
    public function regularMessages() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("User/regularMessages", ["user" => $user, "profile" => $profile]);
    }
    
    // method to bring admin to their browse page
    #[\app\filters\Regular]
    public function adminBrowse() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime = new \app\models\Anime();
        $allAnime = $anime->getAllAnime();

        $this->view("User/adminBrowse", ["anime" => $allAnime, "user" => $user, "profile" => $profile]);
    }

    // method to bring regulars to their browse page
    #[\app\filters\Admin]
    public function regularBrowse() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime = new \app\models\Anime();
        $allAnime = $anime->getAllAnime();

        $this->view("User/regularBrowse", ["anime" => $allAnime, "user" => $user, "profile" => $profile]);
    }

    #[\app\filters\Admin]
    public function addFavAnime($anime_id) {
        $anime = new \app\models\Anime();
        $animelist = new \app\models\Animelist();
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $animelist = $animelist->getUserAL($_SESSION['user_id']);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime->getAnimeFromList($anime_id, $animelist->animelist_id);
        $allAnimeFromList = $anime->getAllAnimeFromList($animelist->animelist_id);
        $allFavAnimeFromList = $anime->getAllFavAnimeFromList($animelist->animelist_id);
        foreach ($allAnimeFromList as $animeInList) {
            if ($anime_id == $animeInList->anime_id) {
                if ($animeInList->favorite == 'n') {
                    $fav = 'y';
                    $anime->updateFavAnimeFromList($animelist->animelist_id, $animeInList->anime_id, $fav);
                } else {
                    $fav = 'n';
                    $anime->updateFavAnimeFromList($animelist->animelist_id, $animeInList->anime_id, $fav);
                }
            }
        }
        header("location:".BASE."User/regularAnimeList");
    }

    public function regularEditAnimeList($anime_id) {
        $anime = new \app\models\Anime();
        $animelist = new \app\models\Animelist();
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $animelist = $animelist->getUserAL($_SESSION['user_id']);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime = $anime->getAnimeFromList($anime_id, $animelist->animelist_id);
        if (isset($_POST['action'])) {
            $anime->UpdateAnimeFromList($animelist->animelist_id, $anime->anime_id, $_POST['status'], $_POST['rating']);
            header("location:".BASE."User/regularAnimeList");
            return;
        }
        $this->view("User/regularEditAnimeList", ["user" => $user, "profile" => $profile, "anime" => $anime]);
    }

    public function deletePost($profile_post_id) {
        $profilePost = new \app\models\ProfilePost();
        $profilePost->deletePost($profile_post_id);
        header("location:".BASE."User/regularIndex");
    }
}