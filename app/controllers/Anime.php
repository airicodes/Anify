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

        // if preview button is clicked, show user preview of image.
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


        // if cancel button is pressed, bring back admin to admin index page.
        if (isset($_POST["cancel"])) {
            header("location:".BASE."User/adminIndex");
            return;
        }

        if (isset($_POST["confirm"])) {
            $animeTitle = trim($_POST["animeTitle"]);
            $animeDescription = trim($_POST["animeDescription"]);
            $animeEpisodes = trim($_POST["animeEpisodes"]);
            $animeGenre = trim($_POST["animeGenre"]);
            $animeStatus = trim($_POST["animeStatus"]);
            $animeStudio = trim($_POST["animeStudio"]);
            $animeCreator = trim($_POST["animeCreator"]);
            $animeDate = trim($_POST["animeDate"]);

            if ($_FILES["newPicture"]["size"] < 1 ||  empty($animeTitle) || empty($animeDescription) || empty($animeEpisodes)
                || empty($animeGenre) || empty($animeStatus) || empty($animeStudio) || empty($animeCreator) || empty($animeDate)) {
                $this->view("Anime/addAnime", ["error" => "All fields must be filled", "image" => null, "user" => $user, "profile" => $profile]);
                return;
            }

            // check picture
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

            $anime = new \app\models\Anime();
            $allAnime = $anime->getAllAnime();
            foreach ($allAnime as $currentAnime) {
                if ($animeTitle == $currentAnime->anime_title) {
                    $this->view("Anime/addAnime", ["error" => "$animeTitle already exists...", "image" => null, "user" => $user, "profile" => $profile]);
                    return;
                }
            }

            if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                $anime->picture_link = "/".$this->folder.$filename;
            } else {
                $this->view("Anime/addAnime", ["error"=>"I was not able to upload your image, sorry about that...", "image" => null, "user" => $user, "profile" => $profile]);
                return;
            }

            $anime->anime_name = $animeTitle;
            $anime->anime_creator = $animeCreator;
            $anime->anime_date = $animeDate;
            $anime->anime_description = $animeDescription;
            $anime->anime_episodes = $animeEpisodes;
            $anime->anime_status = $animeStatus;
            $anime->anime_studio = $animeStudio;
            $anime->anime_genre = $animeGenre;
            $anime->addAnime();
            header("location:".BASE."User/adminIndex");
        }

        $this->view("Anime/addAnime", ["error" => "", "image" => "/uploads/Rectangle_157.png", "user" => $user, "profile" => $profile]);
    }

    // the anime page. where a specific anime is shown to an admin with add, edit, and delete options.
    #[\app\filters\Regular]
    public function adminAnimePage($anime_id) {
        $anime = new \app\models\Anime();
        $anime = $anime->getAnime($anime_id);
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        // this code needs to be implemented.
        if (isset($_POST["add"])) {
            $this->view("Anime/adminAnimePage", ["anime" => $anime, "user" => $user, "profile" => $profile]);
            return;
        }

        // editing an anime.
        if (isset($_POST["edit"])) {
            header("location:".BASE."Anime/editAnime/$anime_id");
        }

        if (isset($_POST["delete"])) {
            header("location:".BASE."Anime/deleteAnime/$anime_id");
        }


        $this->view("Anime/adminAnimePage", ["anime" => $anime, "user" => $user, "profile" => $profile]);
    }

    // The anime page for a regular. shows the add to list item.
    #[\app\filters\Admin]
    public function regularAnimePage($anime_id) {
        $anime = new \app\models\Anime();
        $anime = $anime->getAnime($anime_id);
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);

        $this->view("Anime/regularAnimePage", ["anime" => $anime, "user" => $user, "profile" => $profile]);
    }

    #[\app\filters\Regular]
    public function deleteAnime($anime_id) {
        $anime = new \app\models\Anime();
        $anime = $anime->getAnime($anime_id);

        if (isset($_POST["cancel"])) {
            header("location:".BASE."Anime/adminAnimePage/$anime->anime_id");
        }
        if (isset($_POST["delete"])) {
            $anime->deleteAnime();
            header("location:".BASE."User/adminBrowse");
        }
        
        $this->view("Anime/deleteAnime", $anime);
    }

    #[\app\filters\Regular]
    public function editAnime($anime_id) {
        $user = new \app\models\User();
        $user = $user->getUser($_SESSION["user_id"]);
        $profile = new \app\models\Profile();
        $profile = $profile->getProfile($_SESSION["user_id"]);
        $anime = new \app\models\Anime();
        $anime = $anime->getAnime($anime_id);

        if (isset($_POST["cancel"])) {
            header("location:".BASE."Anime/adminAnimePage/$anime_id");
        }

        // this if statement is to view a preview of the profile picture
        if (isset($_POST["preview"])) {
            if ($_FILES["newPicture"]["size"] < 1) {
                $this->view('Anime/editAnime', ['error'=>"No image was selected", "user" => $user, "profile" => $profile, "anime" => $anime]);
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
                    $this->view('Anime/editAnime', ['error'=>"Bad file type", "user" => $user, "profile" => $profile, "anime" => $anime]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Anime/editAnime', ['error'=>"File too large", "user" => $user, "profile" => $profile, "anime" => $anime]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $anime->picture_link = "/".$this->folder.$filename;
                    $this->view("Anime/editAnime", ["error"=>"", "user" => $user, "profile" => $profile, "anime" => $anime]);
                } else {
                    $this->view("Anime/editAnime", ["error"=>"Cant upload", "user" => $user, "profile" => $profile, "anime" => $anime]);
                }
            }

            return;
        }

        // to update a new anime, when confirm button is pressed.
        if (isset($_POST["confirm"])) {
            $newAnimeTitle = trim($_POST["newAnimeTitle"]);
            $newAnimeDescription = trim($_POST["newAnimeDescription"]);
            $newAnimeEpisodes = trim($_POST["newAnimeEpisodes"]);
            $newAnimeGenre = trim($_POST["newAnimeGenre"]);
            $newAnimeStatus = trim($_POST["newAnimeStatus"]);
            $newAnimeStudio = trim($_POST["newAnimeStudio"]);
            $newAnimeCreator = trim($_POST["newAnimeCreator"]);
            $newAnimeDate = trim($_POST["newAnimeDate"]);

            if (!($newAnimeTitle == $anime->anime_name)) {
                $allAnime = $anime->getAllAnime();
                foreach ($allAnime as $currentAnime) {
                    if (strtolower($currentAnime->anime_name) == strtolower($newAnimeTitle)) {
                        $this->view("Anime/editAnime", ["error" => "This anime already exists", "anime" => $anime, "user" => $user, "profile" => $profile]);
                        return;
                    }
                }
            }

            if (empty($newAnimeTitle) || empty($newAnimeDescription) || empty($newAnimeEpisodes) || empty($newAnimeGenre) || empty($newAnimeStatus) 
                || empty($newAnimeStudio) || empty($newAnimeCreator) || empty($newAnimeDate)) {
                    $this->view("Anime/editAnime", ["error" => "All fields must be filled", "anime" => $anime, "user" => $user, "profile" => $profile]);
                    return;
                }

            if ($_FILES["newPicture"]["size"] < 1 ) {
                $anime->anime_name = $newAnimeTitle;
                $anime->anime_description = $newAnimeDescription;
                $anime->anime_episodes = $newAnimeEpisodes;
                $anime->anime_genre = $newAnimeGenre;
                $anime->anime_status = $newAnimeStatus;
                $anime->anime_studio = $newAnimeStudio;
                $anime->anime_creator = $newAnimeCreator;
                $anime->anime_date = $newAnimeDate;
                $anime->updateAnime();
                header("location:".BASE."Anime/adminAnimePage/$anime_id");
            } else {
                $check = getimagesize($_FILES['newPicture']['tmp_name']);

                $mime_type_to_extension = ['image/jpeg'=>'.jpg',
                                            'image/gif'=>'.gif',
                                            'image/bmp'=>'.bmp',
                                            'image/png'=>'.png'
                                            ];

                if($check !== false && isset($mime_type_to_extension[$check['mime']])){
                    $extension = $mime_type_to_extension[$check['mime']];
                }else{
                    $this->view('Profile/regularEditProfile', ['error'=>"Bad file type", "anime" => $anime, "user" => $user, "profile" => $profile]);
                    return;
                }

                $filename = uniqid().$extension;
                $filepath = $this->folder.$filename;

                if($_FILES['newPicture']['size'] > 4000000){
                    $this->view('Anime/editAnime', ['error'=>"File too large", "user" => $user, "profile" => $profile, "anime" => $anime]);
                    return;
                }
                if(move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)){
                    $anime->picture_link = "/".$this->folder.$filename;
                } else {
                    $this->view("Anime/editAnime", ["error"=>"Can't upload", "user" => $user, "profile" => $profile, "anime" => $anime]);
                    return;
                }

                $anime->anime_name = $newAnimeTitle;
                $anime->anime_description = $newAnimeDescription;
                $anime->anime_episodes = $newAnimeEpisodes;
                $anime->anime_genre = $newAnimeGenre;
                $anime->anime_status = $newAnimeStatus;
                $anime->anime_studio = $newAnimeStudio;
                $anime->anime_creator = $newAnimeCreator;
                $anime->anime_date = $newAnimeDate;
                $anime->updateAnime();
                header("location:".BASE."Anime/adminAnimePage/$anime_id");
            }

            return;
        }

        $this->view("Anime/editAnime", ["error" => "", "anime" => $anime, "user" => $user, "profile" => $profile]);
    }
}