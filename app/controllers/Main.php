<?php

namespace app\controllers;

class Main extends \app\core\Controller {

    // the function to log into an account.
    #[\app\filters\SessionCheck]
    public function login() {

        if (isset($_POST["action"])) {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if (empty($username) || empty($password)) {
                $this->view("Main/login", "One or both fields are empty");
                return;
            }

            $user = new \app\models\User();
            $user = $user->getUserByUsername($_POST['username']);

            if ($user != false && password_verify($_POST["password"], $user->hash)) {
                $_SESSION["user_id"] = $user->user_id;
                $_SESSION["username"] = $user->username;
                $_SESSION["role"] = $user->role;

                $doesProfileExist = new \app\models\Profile();
                $doesProfileExist = $doesProfileExist->getProfile($_SESSION["user_id"]);

                if (!$doesProfileExist) {
                    header("location:".BASE."Profile/profile");
                } else if ($user->role == "admin") {
                    header("location:".BASE."User/adminIndex");
                } else if ($user->role == "regular") {
                    header("location:".BASE."User/regularIndex");
                }
            } else {
                $this->view('Main/login', 'Wrong username and password combination');
            }
        } else {
            $this->view("Main/login");
        }

    }

    // the function to register a new user.
    #[\app\filters\SessionCheck]
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

            if (strlen($username) > 14) {
                $this->view("Main/register", "Maximum username length is 14 characters");
                return;
            }

            $user = new \app\models\User();
            $user->username = $_POST["username"];
            $user->role = "regular";

            $allUsers = $user->getAllUsers();
            foreach ($allUsers as $currentUser) {
                if (strtolower($currentUser->username) == strtolower($user->username)) {
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