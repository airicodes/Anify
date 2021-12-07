<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');   
    #body {
        /* Full height */
        height: 100%; 

        /* To change the font */
        font-family: 'Poppins', sans-serif;
    }

    #problemSolversImage {
        width: 250px;
    }

    /* Use to center the box at the middle of the page */
    #center{
        position: absolute;
        width: 700px;
        height: 600px;
        top: -300;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    /*  The design of the box in the middle */
    #loginBox {
        width: 650px;
        height: 760px;
        background-color: #03050D;
        border-radius: 25px;
        opacity: 80%;
    }

    .anchors a:hover {
        color:red;
    }

    /* To change the font size of anify */ 
    #websiteName{
        position: relative;
        font-size: 100px;
        margin: -24px;
        z-index: 1;
    }

    /* To change the color of the ify in anify */
    #ify {
        color: #E168BF;
    }

    /* To change the design of the input*/
    .input {
        width: 500px;
        height: 55px;
        border-radius: 10px;
        margin-top: 0%;
        padding-left: 10px;
        padding-right: 10px;
    }
    
    /* To change the color, radius and the margin top of the log in button */
    #loginButton {
        /* background-color: red; */
        background-color: #e168bf;
        width: 400px;
        border-radius: 15px;
        margin-top: 6%;
    }

    #cancel {
        /* background-color: green; */
        width: 120%;
        border-radius: 15px;
        margin-top: 35%;
        margin-left:100%
    }

    #error_messages {
        color: red;
        font-weight: bold;
    }

    .file {
        color: white;
    }

    #circle {
        width:20%;
        opacity: 2;
    }

    #image-file-placement {
        margin-left: 2%
    }

    .recommended {
        padding-left: 1.2%;
        padding-right: 1.2%;
    }

    .skip {
        text-decoration: none;
    }

    .preview {
        margin-top: -3%;
        margin-right: 79%;
    }

    .image {
        margin-bottom:5%;
    }

    /* To insert the Poppins font style */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');   
    
    #body{
        background-color: #1E2336; 
        padding: 20px;
        font-family: 'Poppins', sans-serif;
        background-size: 85% 85%;
        background-repeat: no-repeat;
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
        margin-top: 40%;
    }

    #usernameBox {
        margin-top: 0%;
    }
    
    .labels {
        margin-right:57%;
    }

    .biolabel {
        margin-top: 5%;
        margin-right:65%;
    }
    
    


</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body id="body">

    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light"href="<?=BASE?>User/adminIndex"><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- To go to ABOUT PAGE -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>User/adminAbout">about</a>
                </li>
                <!-- To go to ADD ANIME PAGE -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>Anime/addAnime">add anime</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the browse anime page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/adminBrowse">browse</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the browse page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/regulars">regulars list</a>
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

    <div id="center">
        <h1 id="websiteName" class="text-light text-center">An<b id="ify">ify</b></h1>
        <div id="loginBox" class="mx-4">
            <div class="text-center">
                <br>
                <h1 class="mt-2 text-light recommended">Edit <?=$data["user"]->username?>'s Profile</h1>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Where user enters new username -->
                    <h6 class="text-light labels">New Username:</h6>
                    <input id="usernameBox" class="input" name="newUsername" type="text" value="<?=$data["user"]->username;?>">
                    <!-- Where the user input his new bio -->
                    <h6 class="text-light biolabel">New Bio:</h6>
                    <textarea name="newBio" class="input" cols="70" rows="30" style="resize:none; height: 30%;"><?=$data["profile"]->bio; ?></textarea>
                    <!-- Where the user input his new password -->
                    <br>
                    <br>
                    <br>
                    <label for="" class="text-light">Edit <?=$data["user"]->username?>'s avatar</label>
                    <div id="image-file-placement">
                        <img id="circle" class="rounded-circle image" src="<?=$data["profile"]->filename ?>" alt="">
                        <input class="input file" type="file" name="newPicture">
                        <button name="preview" type="submit" class="btn text-light btn-secondary preview">Preview</button>
                    </div>
                    <button name="action" id="loginButton" type="submit" class="btn btn-secondary btn-lg">Save changes</button>
                    <br>
                </form>
                <a class="text-light" style="text-decoration:none;" href="<?=BASE?>User/regulars">Go back</a>
            </div>
            <br>
            <center>
                <h4 id="error_messages">
                <?php
                    echo $data["error"];
                ?>
                </h4>
            </center>
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