<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        /* To insert the Poppins font style */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');   
        
        #body{
            background-color: #1E2336; 
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

        /* Change the color of the fy in Anify */
        #fy {
            color: #E168BF;
        }

        .navbar-brand {
            margin-left: 20px;
        }

        /* Change the color and position of the search button */
        #searchButton {
            background-color: #151929;
            margin-left: 300px;
            margin-right: 10px;
        }

        /* Change the size of the search input */
        #searchInput {
            width: 300px;
        }

        /* Change the color, height, border and the padding of the box that covers the user's information */
        #userInformationBox {
            background-color: rgba(3, 5, 13, 0.61);
            height: 34.5rem;
            border-radius: 25px;
            padding-bottom: 2%;
        }


        #editProfileButton{
            width: 140px;
            margin-right: 10px;
        }

        #deleteProfileButton {
            margin-left: 8px;
        }

        #secondNavbar .navbar-nav .nav-item{
            font-size: 25px;
            width: 150px;
        }

        /* For the hovering effect of the second navbar */
        #secondNavbar .navbar-nav a:hover{
            color: #E168BF !important;
        }

        /* changing the color of the active nav item */
        #secondNavbar .navbar-nav a.active{
            background-color: #151929;
            border-radius: 25px;
        }
        
        /* the box where all the anime list and manga list are located */
        #listBox{
            background-color: rgba(3, 5, 13, 0.61);
            width: 1000px;
            height: max-content;
            border-radius: 25px;
            padding: 10px;
        }

        #logo {
            width: 200px;
            margin-top: -4%;
        }

        /* to change the border of the radius */
        #adminLogo {
            border-radius: 20px;
            width: 200px;
        }

        .pfp {
            width: 60%;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/adminIndex"><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- To go to ABOUT PAGE -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>User/adminAbout">about</a>
                </li>
                <!-- To go to ADD ANIME PAGE -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="">add anime</a>
                </li>
            </ul>
            <!-- This is for the search bar -->
            <form action="" method="POST" class="d-flex justify-content-center">
                <button class="btn" id="searchButton" type="submit">
                    <!-- Adding the search icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-light" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search users/mangas/animes" aria-label="Search">
            </form>
        </div>
    </nav>

    <!-- This for the actual body of the page -->
    <div class="container-xl container-fluid">
        <div class="row">
            <!-- the user information box -->
            <div id="userInformationBox" class="col-3 mt-5">
                <!-- Profile Picture -->
                <img class="rounded-circle mt-3 img-responsive center-block d-block mx-auto pfp" src="<?php echo $data["profile"]->filename; ?>" data-rendered="true">
                <!-- Username -->
                <h2 class="text-center text-light mt-2"><?php echo $data["user"]->username; ?></h2>
                <!-- admin logo -->
                <div class="d-flex flex-column">
                    <!-- If we make this disabled it will make the button darker -->
                <button id="adminlogo" class="btn btn-danger align-self-center" disabled>administrator</button>
                <!-- Edit and delete button -->
                </div>
                <div class="mt-3 d-flex flex-row">
                    <button id="editProfileButton" type="button" class="btn btn-outline-info">Edit Profile</button>
                    <button id="deleteProfileButton" type="button" class="btn btn-outline-danger">Delete Account</button>
                </div>
                <h5 class="text-light mt-3">bio</h5>
                <!-- Bio -->
                <p class="text-light">
                    <?php
                    echo $data["profile"]->bio;
                    ?>
                </p>
            </div>

            <!-- The user's post, anime list, manga list, and setting section -->
            <div class="col-9 mt-4 pt-3">
                <!-- The second nav bar -->
                <nav id="secondNavbar" class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse">
                      <div class="navbar-nav">
                        <!-- Posts -->
                        <a class="nav-item mx-1 text-center nav-link text-light active disabled">posts</a>
                        <!-- Anime List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="#">anime list</a>
                        <!-- Manga List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="#">messages</a>
                        <!-- Settings -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="<?=BASE?>User/adminSettings">settings</a>
                      </div>
                    </div>
                </nav>
                
                <!-- post, animelist, mangalist, and settings box -->
                <!-- The box where all the post, anime list, mangalist and settings will be placed -->
                <div id="listBox">
                    <div style="height: 468px;overflow: scroll;">
                        <table class="table">
                            <tbody>
                                <!-- Per message. We need to put a for loop then put this tr inside of it  -->
                               <tr>
                                   <!-- Place where to put the message and the time stamp -->
                                 <td class="text-light"> Manns Steins gate is fucking trash <br> 22:33 PM 09/31/21</td>
                               </tr>

                               <tr>
                                   <!-- Place where to put the message and the time stamp -->
                                 <td class="text-light"> We love one piece!!!  <br> 22:33 PM 09/31/21 </td>
                               </tr>
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