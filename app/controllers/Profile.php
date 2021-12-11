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
                $animelist = new \app\models\Animelist();
                $animelist->insertUserAL($_SESSION["user_id"]);
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
                    $animelist = new \app\models\Animelist();
                    $animelist->insertUserAL($_SESSION["user_id"]);
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
                $animelist = new \app\models\Animelist();
                $animelist->insertUserAL($_SESSION["user_id"]);
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
                $this->view("Profile/adminEditProfile", ["error" => "Maximum username length is 14 characters", "user" => $user, "profile" => $profile]);
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
                $this->view("Profile/regularEditProfile", ["error" => "Maximum username length is 14 characters", "user" => $user, "profile" => $profile]);
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

    // Search the profile of the username
    public function searchProfiles() {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime = new \app\models\Anime();

        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($_SESSION["user_id"]);
        $searchInput = trim($_POST["searchInput"]);

        if (empty($searchInput)) {
            $this->view("User/regularIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"", "errorSearch"=>"Nothing was entered"]);
            return;
        } 
        if (strlen($searchInput) > 140) {
            $this->view("User/regularIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"", "errorSearch"=>"Text must be 30 characters max"]);
            return;
        }
        
        $userSearchResults = $profile->searchProfile($searchInput);
        $animeSearchResults = $anime->searchAnime($searchInput);

        $this->view("Profile/SearchProfile", ["animes" => $animeSearchResults, "users" => $userSearchResults]);
    }

    // Goes to the searched regular index
    public function regularSearchProfile($user_id) {
        $user = new \app\models\User();
        $user = $user->getUser($user_id);

        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($user_id);


        $profilePost = new \app\models\ProfilePost();
        $posts = $profilePost->getAllPost($user_id);

        if ($user->role == "regular") {
            $this->view("Profile/regularSearchIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"", "errorSearch"=>""]);
        } else {
            $this->view("Profile/adminSearchIndex", ["user" => $user, "posts"=>$posts,"profile" => $profile, "error"=>"", "errorSearch"=>""]);
        }
    }

    // Like your own post
    public function likeOwnPost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->addLike($post_id);
        header("location:".BASE."User/regularIndex/$searchUserId");
    }

    // Unlike your own post
    public function unLikeOwnPost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->removeLike($post_id);
        header("location:".BASE."User/regularIndex/$searchUserId");
    }

    // Like your own post for admin
    public function adminLikeOwnPost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->addLike($post_id);
        header("location:".BASE."User/regularIndex/$searchUserId");
    }

    // Unlike your own post for admin
    public function adminUnLikeOwnPost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->removeLike($post_id);
        header("location:".BASE."User/adminIndex/$searchUserId");
    }

    // Likes the post of the user
    public function likePost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->addLike($post_id);
        header("location:".BASE."Profile/regularSearchProfile/$searchUserId");
    }

    // Unlke the post of the user
    public function unLikePost($post_id, $searchUserId) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $post_like = new \app\models\PostLike();
        $post_like->user_id = $user->user_id;
        $post_like->profile_post_id = $post_id;
        $post_like->removeLike($post_id);
        header("location:".BASE."Profile/regularSearchProfile/$searchUserId/$searchUserId->role");
    }

    // Methods to navigate to other user's anime list 
    public function otherAnimeList($user_id) {
        $user = new \app\models\User();
        $user = $user->getUser($user_id);
        
        $anime = new \app\models\Anime();
        $animelist = new \app\models\Animelist();
        $animelist = $animelist->getUserAL($user_id);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($user_id);
        $allAnimeFromList = $anime->getAllAnimeFromList($animelist->animelist_id);
        $allFavAnimeFromList = $anime->getAllFavAnimeFromList($animelist->animelist_id);

        if ($user->role == "regular") {
            $this->view("Profile/otherProfileAnimeList", ["user" => $user, "profile" => $profile, "list"=> $allAnimeFromList,
            "favlist" => $allFavAnimeFromList]);
        } else  {
            $this->view("Profile/otherAdminProfileAnimeList", ["user" => $user, "profile" => $profile, "list"=> $allAnimeFromList,
            "favlist" => $allFavAnimeFromList]);
        }
    }

    // Method that navigates the user to the send message page
    public function otherSendMessage($user_id) {
        $user = new \app\models\User();
        $user = $user->getUser($user_id);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($user_id);

        if ($user->role == "regular") {
            $this->view("Profile/otherProfileMessage", ["user" => $user, "profile" => $profile, "error"=>""]);
        } else  {
            $this->view("Profile/otherAdminProfileMessage", ["user" => $user, "profile" => $profile, "error"=>""]);
        }
    }

    public function viewReview($user_review_id, $user_id) {
        $anime = new \app\models\Anime();
        $review = new \app\models\Review();
        $animelist = new \app\models\Animelist();
        $user = new \app\models\User();
        $user = $user->getUser($user_id);
        $review = $review->getReview($user_review_id, $user->user_id);
        $anime = $anime->getAnime($review->anime_id);
        
        if ($user->role == "admin") {
            $this->view('Profile/OtherProfileReview', ["user" => $user, "review" => $review, "anime" => $anime]);
        } else {
            $this->view('Profile/OtherProfileReview', ["user" => $user, "review" => $review, "anime" => $anime]);
        }
    }

    public function otherAdminProfileReviews($user_id) {
            $anime = new \app\models\Anime();
            $user = new \app\models\User();
            $user = $user->getUser($user_id);
            $profile = new \app\models\Profile();
            $profile = $profile->getProfile($user_id);
            $reviews = $anime->getAllReviews($user_id);
    
            if ($user->role == 'admin') {
                $this->view("Profile/otherAdminProfileReviews", ["user" => $user, "profile" => $profile, "reviews" => $reviews]);
            } else {
                $this->view("Profile/otherRegularProfileReviews", ["user" => $user, "profile" => $profile, "reviews" => $reviews]);
            }
    }

    public function otherRegularProfileReviews($user_id) {
        $anime = new \app\models\Anime();
        $user = new \app\models\User();
        $user = $user->getUser($user_id);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($user_id);
        $reviews = $anime->getAllReviews($user_id);

        if ($user->role  == 'admin') {
            $this->view("Profile/otherAdminProfileReviews", ["user" => $user, "profile" => $profile, "reviews" => $reviews]);
        } else {
            $this->view("Profile/otherRegularProfileReviews", ["user" => $user, "profile" => $profile, "reviews" => $reviews]);
        }
}
    

    // Method allows other user to send message to each other
    public function sendMessage($user_id) {
        $user = new \app\models\User();
        $otherUser = $user->getUser($user_id);
        $currentUser =  $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($user_id);
        
        $message = new \app\models\Message();
        $message->sender = $_SESSION["user_id"];
        $message->receiver = $user_id;
        $message->read_status = "unread";
        $newMessage = trim($_POST["message"]);
        if ($otherUser->role == "regular") {
            if (empty($newMessage)) {
                $this->view("Profile/otherProfileMessage", ["user" => $otherUser, "profile" => $profile, "error"=>"Nothing was entered"]);
                return;
            } 
            if (strlen($newMessage) > 140) {
                $this->view("Profile/otherProfileMessage", ["user" => $otherUser, "profile" => $profile, "error"=>"Text must be 140 characters max"]);
                return;
            }
            
            $message->message = $newMessage;
            $message->addMessage();
            header("location:/Profile/otherSendMessage/$user_id");

        } else {

            if (empty($newMessage)) {
                $this->view("Profile/otherAdminProfileMessage", ["user" => $otherUser, "profile" => $profile, "error"=>"Nothing was entered"]);
                return;
            } 
            if (strlen($newMessage) > 140) {
                $this->view("Profile/otherAdminProfileMessage", ["user" => $otherUser, "profile" => $profile, "error"=>"Text must be 140 characters max"]);
                return;
            }

            $message->message = $newMessage ;
            $message->addMessage();
            header("location:/Profile/otherSendMessage/$user_id");
        }

    }

        // this is where the admin can edit the regulars username, bio, and pfp.
        #[\app\filters\Regular]
        public function editRegular($user_id) {
            $user = new \app\models\User();
            $user = $user->getUser($user_id);
            $profile = new \app\models\Profile();
            $profile = $profile->getProfile($user_id);
    
            // this if statement is to view a preview of the profile picture
        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Profile/editRegular', ['error'=>"No image was selected",'image'=> "/uploads/defaultAvatar.png", "user" => $user, "profile" => $profile]);
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
                    $this->view('Profile/editRegular', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Profile/editRegular', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $profile->filename = "/".$this->folder.$filename;
                    $this->view("Profile/editRegular", ["error"=>"", "user" => $user, "profile" => $profile]);
                } else {
                    $this->view("Profile/editRegular", ["error"=>"Cant upload", "user" => $user, "profile" => $profile]);
                }
            }

            return;
        }

        // code for when save changes is pressed.
        if (isset($_POST["action"])) {
            $newUsername = trim($_POST["newUsername"]);
            $newBio = trim($_POST["newBio"]);

            if (strlen($newUsername) > 14) {
                $this->view("Profile/editRegular", ["error" => "Maximum username length is 20 characters", "user" => $user, "profile" => $profile]);
                return;
            }

            // checking if username is empty, and checking if the username change does not exist.
            if (empty($newUsername)) {
                $this->view("Profile/editRegular", ["error" => "Username cannot be empty", "user" => $user, "profile" => $profile]);
                return;
            } else if (!($newUsername == $user->username)) {
                $allUsers = $user->getAllUsers();
                foreach ($allUsers as $currentUser) {
                    if (strtolower($currentUser->username) == strtolower($newUsername)) {
                        $this->view("Profile/editRegular", ["error" => "This username already exists", "user" => $user, "profile" => $profile]);
                        return;
                    }
                }
            }

            if ($_FILES["newPicture"]["size"] < 1 && empty(trim($_POST["newBio"]))) {
                $profile->bio = "No bio yet...";
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/regulars");
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
                    $this->view('Profile/editRegular', ['error'=>"Bad file type", "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Profile/editRegular', ['error'=>"File too large", "user" => $user, "profile" => $profile]);
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
                    header("location:".BASE."User/regulars");
                    return;
                } else {
                    $this->view("Profile/adminEditProfile", ["error"=>"I am not able to upload the image... sorry.", "user" => $user, "profile" => $profile]);
                }
            } else if ($_FILES["newPicture"]["size"] < 1 && !empty(trim($_POST["newBio"]))) {
                $profile->bio = $_POST["newBio"];
                $profile->updateProfile();
                $user->username = $_POST["newUsername"];
                $user->updateUsername();
                header("location:".BASE."User/regulars");
            }

            return;
        }
        
    
            $this->view("Profile/editRegular", ["user" => $user, "profile" => $profile, "error" => ""]);
        }


}