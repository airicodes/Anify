<?php

namespace app\controllers;

use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

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

        // code to delete account
        if (isset($_POST["deleteAccount"])) {
            $_SESSION["deleteAccount"] = "clicked";
            $this->view("User/adminIndex", ["user" => $user, "profile" => $profile]);

        }


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

        // code to change password.
        if (isset($_POST["action"])) {
            $oldPass = trim($_POST["oldPassword"]);
            $newPass = trim($_POST["newPassword"]);
            $confirmNewPass = trim($_POST["confirmNewPassword"]);

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

    #[\app\filters\Regular]
    public function adminAbout() {
        $this->view("User/adminAbout");        
    }

    #[\app\filters\Admin]
    public function regularAbout() {
        $this->view("User/regularAbout");
    }
}