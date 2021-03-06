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

        /* To change the width of the nav-items */
        .nav-item {
            width: 120px;
            text-align: center;
        }

        /* To change the color and position of the search button */
        #searchButton {
            background-color: #151929;
            margin-left: 150px;
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
            margin-left: 460px;
            border-radius: 25px;
        }

        #smallProfileBox p {
            font-size: 8px;
        }

        /* To change the profile icon */
        #smallProfileIcon {
            width: 50px;
        }

        /* To change the size of the anime image */ 
        #animeImage{
            height: 150px;
        }
        
        /* To change the position of the title of the anime */
        #animeTitle {
            vertical-align: middle;
            font-size: 40px;
        }

        /* To remove the text decoration of title of the anime  and the change the position of it*/
        #animeTitle a {
            text-decoration: none;
            color: white;
        }

        #animeTitle a:hover {
            color: #E168BF;
        }
        

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/regularIndex"><h2>An<b id="ify">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
            <?php
                    if ($_SESSION['role'] == 'admin') {
                        echo '<li class="nav-item">
                        <a class="nav-link text-light" href="/User/adminAbout">about</a>
                    </li>
                    <!-- To go to ADD ANIME PAGE -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/Anime/addAnime">add anime</a>
                    </li>
                    <li class="nav-item">
                        <!-- To go to the browse anime page -->
                        <a class="nav-link text-light" href="/User/adminBrowse">browse</a>
                    </li>
                    <li class="nav-item">
                        <!-- To go to the browse page -->
                        <a class="nav-link text-light" href="/User/regulars">regulars list</a>
                    </li>';
                    } else {
                        echo '<li class="nav-item">
                        <a class="nav-link text-light" href="/User/adminAbout">about</a>
                    </li>
                    <li class="nav-item">
                        <!-- To go to the browse anime page -->
                        <a class="nav-link text-light" href="/User/regularBrowse">browse</a>
                    </li>';
                    }
                    ?>
            </ul>
            <!-- This is for the search bar -->
            <form action="/Profile/searchProfiles" method="POST" class="d-flex justify-content-center">
                <button class="btn" id="searchButton" name="" type="submit">
                    <!-- Adding the search icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-light" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <!-- The input of the search. This is where the user input the things he wants to search -->
                <input id="searchInput" class="form-control me-2" name="searchInput" type="search" placeholder="Search for animes/users" aria-label="Search">
            </form>

            <!-- The small profile box that goes to the profile page when clicked -->
            <ul class="navbar-nav d-flex flex-row-reverse">
                <div id="smallProfileBox">
                    <li class="nav-item"> 
                        <!-- The link that goes to the profile page -->
                        <a class="nav-link text-light" href=""> 
                            <!-- user profile picture -->
                            <!-- <img id="smallProfileIcon" class="rounded-circle" src="<?=$data["profile"]->filename;?>" alt=""> -->
                            <!-- the username -->
                            <!-- <p class="mt-2"><?=$data["user"]->username;?></p> -->
                        </a>
                    </li>
                </div>
            </ul>
            
        </div>
    </nav>

    
    <div class="container mt-5">
        <div class="row">
            <!-- The bigbox where the anime informations are located -->
            <div id="bigBox" class="col-8 mt-4 ">
                <div class="container">
                    <div style="height: 600px;overflow: scroll;">
                        <table class="table">
                            <tbody>
                                <!-- Per message. We need to put a for loop then put this tr inside of it  -->
                                <center>
                                <h1 style='color: white; margin-left: -6%;'>Users</h1>
                                </center>
                                <hr>
                                <?php
                                foreach ($data['users'] as $user) {
                                    if (!($user->user_id == $_SESSION["user_id"])) {
                                        echo "<tr>
                                        <td style='text-align:center;'> <a style='text-decoration:none;' class='text-light' href='/Profile/regularSearchProfile/$user->user_id'>$user->username</a><td>
                                        </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                            </table>
                            <table class="table">
                            <tbody>
                                <center>
                                <h1 style='color: white; margin-left: -6%;'>Animes</h1>
                                </center>
                                <hr>
                                <!-- Per message. We need to put a for loop then put this tr inside of it  -->
                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                 foreach ($data['animes'] as $anime) {
                                        echo "<tr>
                                              <td style='text-align:center;'> <a style='text-decoration:none;' class='text-light' href='/Anime/AdminAnimePage/$anime->anime_id'>$anime->anime_name</a><td>
                                            </tr>";
                                 }
                                } else {
                                    foreach ($data['animes'] as $anime) {
                                        echo "<tr>
                                              <td style='text-align:center;'> <a style='text-decoration:none;' class='text-light' href='/Anime/regularAnimePage/$anime->anime_id'>$anime->anime_name</a><td>
                                            </tr>";
                                 }  
                                }
                                ?>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Footer -->
     <footer>
        <div class="text-end mt-5 text-light">
            <img id="logo" src="/app/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
    
</body>
</html>