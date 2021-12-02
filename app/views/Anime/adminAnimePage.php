<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
            height: 600px;
            border-radius: 25px;
            background-color: #03050D !important;
            opacity: 80%;
            margin-left: 240px;
            margin-top: -20px !important;
        }

        /* Use to change the size and radius of the anime image */
        #animeImage {
            height: 350px;
            border-radius: 10px;
        }

        /* Use to change the size of the add anime button */
        #addAnimeButton {
            width: 150px;
        }

        /* Anime attributes: Episodes, Genre, Status, Studio, Creator, Start and End date */ 
        #animeAttributes {
            margin-top: -10px;
        }

        /* To change the color of the values of episodes check line 138 to 151 */
        #animeAttributes p {
            font-size: 15px;
            width: 100px;
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

                <li class="nav-item">
                    <!-- To go to the browse anime page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/adminBrowse">browse</a>
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
                    <li class="nav-item"> 
                        <!-- The link that goes to the profile page -->
                        <a class="nav-link text-light"href=""> 
                            <!-- user profile picture -->
                            <img id="smallProfileIcon" class="rounded-circle" src="<?=$data["profile"]->filename;?>" alt="">
                            <!-- the username -->
                            <p class="mt-2"><?php echo $data["user"]->username; ?></p>
                        </a>
                    </li>
                </div>
            </ul>
            
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!-- The bigbox where the anime informations are located -->
            <div id="bigBox" class="col-8 mt-4 ">
                <div class="container">
                    <div class="row">
                        <!-- The column for the image, anime title, and add button -->
                        <div class="d-flex flex-column col-4 mt-3">
                            <!-- The image of the anime -->
                            <img id="animeImage" src="<?=$data["anime"]->picture_link;?>" alt="">
                            <!-- The anime title -->
                            <h2 class="text-center text-light mt-2"><?=$data["anime"]->anime_name;?></h2>
                            <!-- The add anime button -->
                            <form action="" method="POST">
                                <!-- add to anime list. -->
                                <button name="add" type="submit" id="addAnimeButton" class="btn btn-outline-info text-light align-self-center mt-3">Add to list</button>
                                <!-- The edit anime button -->
                                <button name="edit" type="submit" id="addAnimeButton" class="btn btn-outline-warning text-light align-self-center mt-3">Edit</button>
                                <!-- The remove anime button -->
                                <button name="delete" type="submit" id="addAnimeButton" class="btn btn-outline-danger text-light align-self-center mt-3">Remove</button>
                            </form>
                        </div>

                        <!-- The column for the anime description -->
                        <div class="d-flex flex-column col-8 mt-3">
                            <h2 class="text-secondary">Description</h2>
                            <p class="text-light">
                                <?php
                                    echo "{$data['anime']->anime_description}";
                                ?>
                            </p>

                            <div class="container mt-1">
                                <div class="row">
                                    <div id="animeAttributes" class="d-flex flex-row col">
                                        <!-- The place where to put the number of episodes -->
                                        <h3 class="text-secondary mx-3">Episodes <br> <p class="text-center text-light"><?=$data["anime"]->anime_episodes;?></p> </h3>
                                        <!-- The place where to put the genre of the anime -->
                                        <h3 class="text-secondary mx-3">Genre <p class="text-center text-light"><?=$data["anime"]->anime_genre;?></p> </h3>
                                        <!-- The place where to put the status of an anime -->
                                        <h3 class="text-secondary mx-3">Status <p class="text-center text-light"><?=$data["anime"]->anime_status;?></p> </h3>
                                        <h3 class="text-secondary mx-3">Studio <p class="text-center text-light"><?=$data["anime"]->anime_studio;?></p> </h3>
                                    </div>
                                    <div id="animeAttributes" class="d-flex flex-row col mt-0">
                                        <!-- The place where to put the creator of the anime -->
                                        <h3 class="text-secondary mx-3">Creator <br> <p class="text-center text-light"><?=$data["anime"]->anime_creator;?></p> </h3>
                                        <!-- The place where to put the genre of the anime -->
                                        <h3 class="text-secondary mx-3">Start date <p class="text-center text-light"><?=$data["anime"]->anime_date;?></p> </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <center>
        <a class="text-decoration-none text-light" href="<?=BASE?>User/adminBrowse">Go back</a>
    </center>
     <!-- Footer -->
     <footer>
        <div class="text-end mt-5 text-light">
            <img id="logo" src="/app/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
    
</body>
</html>