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
            header("location:".BASE."Admin/adminIndex");
        }



        $this->view("Anime/addAnime", ["error" => "", "image" => "/uploads/Rectangle_157.png", "user" => $user, "profile" => $profile]);
    }
}