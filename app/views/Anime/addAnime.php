<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');   
        
        #body{
            background-color: #1E2336; 
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

         /* Change the color of the fy in Anify */
         #ify {
            color: #E168BF;
        }

        /* Use to change the margin of the Anify */
        .navbar-brand {
            margin-left: 20px;
        }

        /* To change the color and position of the search button */
        #searchButton {
            background-color: #151929;
            margin-left: 300px;
            margin-right: 10px;
        }

        /* to change the size of search input */
        #searchInput {
            width: 300px;
        }

            
        #logo {
            width: 200px;
            margin-top: 5px;
        }

         /* The anime information box */
         #bigBox {
            height: 550px;
            border-radius: 25px;
            background-color: #03050D !important;
            opacity: 80%;
            margin-left: 240px;
            margin-top: -10px !important;
        }

        /* To change the size of Episode, Genres and etc.. */
        #animeAttributes h3 {
            font-size: 20px;
        }

        /* To change the width of every input type for anime attributes: Episodes, Genre, Status, and etc.. */
        #animeAttributes input{
            width: 100px;
        }

        /* To edit the position of the end date input */
        #animeEndDInput {
            margin-left: -80px !important;
        }

        /* To change the position of confirm and cancel button */
        #buttons {
            margin-right: 200px;
            margin-top: -10px;
        }

        /* To change the size and radius of confirm and cancel button */
        #buttons button {
            width: 200px;
            border-radius: 25px;
        }

        /* The box that wraps the profile icon */
        #smallProfileBox {
            width: 100px;
            background-color: #03050D !important;
            opacity: 80%;
            height: 90px;
            text-align: center;
            margin-left: 300px;
            border-radius: 25px;
        }

        #smallProfileBox p {
            font-size: 8px;
        }

        /* To change the profile icon */
        #smallProfileIcon {
            width: 50px;
        }

    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/adminIndex"><h2>An<b id="ify">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!-- To go to the about page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/adminAbout">about</a>
                </li>

                <li class="nav-item">
                    <!-- To go to the add anime page -->
                    <a class="nav-link text-light" href="<?=BASE?>Anime/addAnime">add anime</a>
                </li>
            </ul>
            <!-- This is for the search bar -->
            <form class="d-flex justify-content-center">
                <button class="btn" id="searchButton" type="submit">
                    <!-- Adding the search icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-light" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <!-- The input of the search. This is where the user input the things he wants to search -->
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search users/mangas/animes" aria-label="Search">
            </form>


            <!-- The small profile box that goes to the profile page when clicked -->
            <ul class="navbar-nav d-flex flex-row-reverse">
                <div id="smallProfileBox">
                    <li class="nav-item" disabled> 
                        <!-- The link that goes to the profile page -->
                        <a class="nav-link text-light" href=""> 
                            <!-- user profile picture -->
                            <img id="smallProfileIcon" class="rounded-circle" src="<?php echo $data["profile"]->filename; ?>" alt="">
                            <!-- the username -->
                            <p class="mt-2"><?php echo $data["user"]->username; ?></p>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>


    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <!-- The bigbox where the anime informations are located -->
                <div id="bigBox" class="col-8 mt-4 ">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex flex-column col-4 mt-3">
                                <img src="/app/background/Rectangle_157.png" alt="">
                                <!-- The image of the anime -->
                                <input class="mt-2 text-light" type="file" name="newPicture">
                                <!-- The anime title -->
                                <input class="mt-3" type="text" name="animeTitle" placeholder="Anime name">
                            </div>


                            <div class="d-flex flex-column col-8 mt-3">
                                <h2 class="text-secondary">Description</h2>
                                <!-- Where the admin input the description of the anime -->
                                <textarea name="animeDescription" id="" cols="30" rows="10" style="resize: none;"></textarea>

                                <div class="container mt-1">
                                    <div class="row">
                                        <div id="animeAttributes" class="d-flex flex-row col mt-5">
                                            <!-- The place where the admin input the number of anime's episode -->
                                            <h3 class="text-secondary mx-3">Episodes <br>  <input type="text" name="animeEpisodes"></h3>
                                            <!-- The place where the admin input the genre of an anime -->
                                            <h3 class="text-secondary mx-3">Genre   <input type="text" name="animeGenre"> </h3>
                                            <!-- The place where the admin input the status of an anime -->
                                            <h3 class="text-secondary mx-3">Status <input type="text" name="animeStatus"> </h3>
                                            <!-- The place where the admin input the studio of an anime -->
                                            <h3 class="text-secondary mx-3">Studio <input type="text" name="animeStudio"> </h3>
                                        </div>
                                        <div id="animeAttributes" class="d-flex flex-row col mt-0">
                                            <!-- The place where the admin input the creator of an anime -->
                                            <h3 class="text-secondary mx-3">Creator <br> <input type="text" name="animeCreator" style="width: 100%"> </h3>
                                            <!-- The place where the admin input the start date of an anime -->
                                            <h3 class="text-secondary mx-3">Start date <br><input type="date" name="animeDate" style="width:100%;"> </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex flex-row col-12 mt-3 justify-content-end">
                    <div id="buttons">
                        <button name="preview" type="submit" class="btn btn-outline-secondary">Preview Image</button>
                        <button name="cancel" type="submit" class="btn btn-outline-danger" >Cancel</button>
                        <button name="add" type="submit" class="btn btn-outline-info mx-1">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

     <!-- Footer -->
    <footer>
        <div class="text-end mt-5 text-light">
            <img id="logo" src="/app/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
</body>
</html>