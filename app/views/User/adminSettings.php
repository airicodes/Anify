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
            margin-left: 16%;
        }

        /* Change the size and the border radius of the send button */ 
        #sendButton {
            width: 120px;
            border-radius: 15px;
        }

         /* to change the border of the radius */
         #adminLogo {
            border-radius: 20px;
            width: 200px;
        }

        .pfp {
            width: 60%;
        }

        #error_messages {
            color:red;
            font-size:100%;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body id="body">
    <?php
    if (isset($_SESSION["passwordUpdate"])) {
    ?>

        <script>
            swal({
                title: "Password Updated",
                text: "<?=$data["user"]->username?>, your password has been successfully updated",
                icon: "success",
                button:"ok"
                });
        </script>


    <?php
        unset($_SESSION["passwordUpdate"]);
    }
    ?>

    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/adminIndex"><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>User/adminAbout">about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>Anime/addAnime">add anime</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the add anime page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/adminBrowse">browse</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the browse page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/regulars">regulars list</a>
                </li>
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
                <button id="adminlogo" class="btn btn-danger align-self-center disabled">administrator</button>
                </div>
                <!-- Edit and delete button -->
                <div class="mt-3 d-flex flex-row">
                    <form action="<?=BASE?>Profile/editProfileButton" method="POST">
                        <button name="editProfile" id="editProfileButton" type="submit" class="btn btn-outline-info">Edit Profile</button>
                    </form>
                    <form action="<?=BASE?>User/deleteAccountButton" method="POST">
                        <button name="deleteAccount" id="deleteProfileButton" type="submit" class="btn btn-outline-danger">Delete Account</button>
                    </form>
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
                        <a class="nav-item mx-1 text-center nav-link text-light" href="<?=BASE?>User/adminIndex">posts</a>
                        <!-- Anime List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="<?=BASE?>User/adminAnimeList">anime list</a>
                        <!-- Manga List -->
                        <a class="nav-item mx-1 text-center nav-link text-light" href="<?=BASE?>User/adminMessages">messages</a>
                        <!-- Settings -->
                        <a class="nav-item mx-1 text-center nav-link text-light active disabled">settings</a>
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
                                <div id="changePassBox" class="col-12 d-flex flex-column">
                                    <form action="" method="POST">
                                        <h2 class="text-light mt-5 text-center">Change password</h2>
                                        <!-- Old password  -->
                                        <input class="mt-1 align-self-center" type="password" name="oldPassword" placeholder="Old password">
                                        <br>
                                        <!-- New password  -->
                                        <input class="mt-1 align-self-center" type="password" name="newPassword" placeholder="New password">
                                        <br>
                                        <!-- New password confirmation  -->
                                        <input class="mt-1 align-self-center" type="password" name="confirmNewPassword" placeholder="Confirm password">
                                        <br>
                                        <button name="action" type="submit" id="confirmButton" class="btn btn-outline-info mt-0 align-self-center">Confirm</button>
                                        <h4 class="mt-3" id="error_messages">
                                        <?php
                                            echo $data["error"];
                                        ?>
                                        </h4>
                                    </form>
                                </div>
                                <div class="container mt-5">
                                    <div class="col-12 d-flex flex-column align-items-end mt-3">
                                        <!-- Log out -->
                                        <!-- When the users clicks on it, the user will be logout -->
                                        <h1><a class="text-danger" style="text-decoration: none;" href="<?=BASE?>Main/logout">Log out</a></h1>
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
            <img id="logo" src="/app/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
</body>
</html>