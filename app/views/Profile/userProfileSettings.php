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
            height: fit-content;
            border-radius: 25px;
            padding-bottom: 20px;
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
            margin-top: 30px;
        }

        /* Change the  border and height of the input inside the change password box */ 
        #changePassBox input {
            border-radius: 4px;
            height: 40px;
            width: 300px;
            padding: 2%;
        }

        /* Change the size and the border radius of the confirm button */ 
        #confirmButton {
            border-radius: 15px;
            width: 160px;
        }

        /* Change the size and the border radius of the send button */ 
        #sendButton {
            width: 120px;
            border-radius: 15px;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light"href=""><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-light"href="">about</a>
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
                <img class="rounded-circle mt-3 img-responsive center-block d-block mx-auto" src="jeremie.jpg" data-rendered="true">
                <!-- Username -->
                <h2 class="text-center text-light mt-2">Jeremie Gaychon</h2>
                <!-- Edit and delete button -->
                <div class="mt-3 d-flex flex-row">
                    <button id="editProfileButton" type="button" class="btn btn-outline-info">Edit Profile</button>
                    <button id="deleteProfileButton" type="button" class="btn btn-outline-danger">Delete Account</button>
                </div>
                <h5 class="text-light mt-3">bio</h5>
                <!-- Bio -->
                <p class="text-light">Hey guys, jeremie gaychon here!
                    I love steins;gate and
                    school! CS gang. Hit me up if you want to eat some good fried rice ayo :> i’m a fakeass felepenes and i’m proud of being white as HECK. #callmerobert #peace #felepen #furrygang #travelgoals</p>
            </div>

            <!-- The user's post, anime list, manga list, and setting section -->
            <div class="col-9 mt-4 pt-3">
                <!-- The second nav bar -->
                <nav id="secondNavbar" class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse">
                      <div class="navbar-nav">
                        <!-- Posts -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="#">posts</a>
                        <!-- Anime List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="#">anime list</a>
                        <!-- Manga List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="#">manga list</a>
                        <!-- Settings -->
                        <a class="nav-item mx-1 text-center nav-link text-light active disabled" href="#">settings</a>
                      </div>
                    </div>
                </nav>

                <!-- post, animelist, mangalist, and settings box -->
                <!-- The box where all the post, anime list, mangalist and settings will be placed -->
                <div id="listBox">
                    <div style="height: 468px;">
                        <div class="container">
                            <div class="row">
                                <!-- Change password section -->
                                <div id="changePassBox" class="col-6 d-flex flex-column">
                                    <h2 class="text-light mt-2" >Change password</h2>
                                    <!-- Old password  -->
                                    <input class="mt-1" type="text" name="oldPassword" placeholder="Old password">
                                    <br>
                                    <!-- New password  -->
                                    <input class="mt-1" type="text" name="newPassword" placeholder="New password">
                                    <br>
                                    <!-- New password confirmation  -->
                                    <input class="mt-1" type="text" name="newPassConfirmation" placeholder="Confirm password">
                                    <br>
                                    <button id="confirmButton" class="btn btn-outline-info mt-0 align-self-center">Confirm</button>
                                </div>

                                <!-- Send feedback section -->
                                <div class="col-6 d-flex flex-column">
                                    <h2 class="text-light mt-2" >Send us a feedback</h2>
                                    <!-- Feedback textarea -->
                                    <textarea name="feedback" id="" cols="30" rows="10" style="resize: none;" ></textarea>
                                    <!-- Send button -->
                                    <!-- Sends the feedback -->
                                    <button id="sendButton" class="btn btn-outline-info mt-0 align-self-end mt-3">Send</button>
                                </div>

                                <div class="container mt-5">
                                    <div class="col-12 d-flex flex-column align-items-end mt-3">
                                        <!-- Log out -->
                                        <!-- When the users clicks on it, the user will be logout -->
                                        <h1><a class="text-danger" style="text-decoration: none;" href="">Log out</a></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="text-end mt-5 text-light">
            <img id="logo" src="/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
</body>
</html>