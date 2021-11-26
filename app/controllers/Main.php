<?php

namespace app\controllers;

class Main extends \app\core\Controller {

    // public function login
    public function login() {



        $this->view("Main/login");
    }

    public function register() {
        if (isset($_POST["action"])) {
            // trimming to make sure they do not just enter spaces.
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $confirm = trim($_POST["confirmPassword"]);

            if (empty($username) || empty($password) || empty($confirm)) {
                $this->view("Main/register", "One or more of your fields are empty");
                return;
            }

            $user = new \app\models\User();
            $user->username = $_POST["username"];
            $user->role = "regular";

            $allUsers = $user->getAllUsers();
            foreach ($allUsers as $currentUser) {
                if ($currentUser->username == $user->username) {
                    $this->view("Main/register", "This username already exists");
                    return;
                }
            }

            if ($_POST["password"] == $_POST["confirmPassword"]) {
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_POST["password"])) {
                    $this->view("Main/register", "<br><br>Password must contain the following: <br>1. At least 8 characters long<br>2. At least 1 number<br>3. At least one uppercase letter");
                    return;
                }
                $user->password = $_POST["password"];
                $user->insertUser();

                $_SESSION["register_status"] = "Registered Successfully";
                header("location:".BASE."Main/login");
            } else {
                $this->view("Main/register", "The passwords are not the same");
                return;
            }
        } else {
            $this->view("Main/register");
        }

    }

    // method to logout a user. destroys the session.
    public function logout() {
		//destroy session variables
		session_destroy();
		header("location:".BASE."Main/login");
	}

}