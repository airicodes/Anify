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
            padding-bottom: 20px;
        }

        .pfp {
            width: 60%;
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
            width: 300px;
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
            height: 86% ;
            border-radius: 25px;
            padding: 10px;
        }

        #logo {
            width: 200px;
            margin-top: 30px;
        }

        #postBox {
            height: 200px;
            width: 300px;
            margin-left: 74%;
        }

        /* Change the size and the position of the submit button */
        #submitButton {
            height: 35px;
            margin-left: 30%;
        }

        #error_messages {
            color: red;
            font-weight: bold;
        }

         /* to change the border of the radius */
         #adminLogo {
            border-radius: 20px;
            width: 200px;
        }

        /* To remove the text decoration of the links */
        .links {
            text-decoration: none;
            color: white;
            padding-left: 10px;
        }

        /* To change the color of the link when the user hovers */ 
        .links:hover{
            color: #E168BF !important;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/regularIndex"><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>User/regularAbout">about</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the regular browse page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/regularBrowse">browse</a>
                </li>
            </ul>
            <!-- This is for the search bar -->
            <form class="d-flex justify-content-center" action="/Profile/searchProfiles" method="POST">
                <button class="btn" id="searchButton" name="searchProfile" type="submit">
                    <!-- Adding the search icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-light" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <input id="searchInput" class="form-control me-2" type="search" name="searchInput" placeholder="Search users/mangas/animes" aria-label="Search">
            </form>

            <h6 id="error_messages">
                <?php
                    echo $data["errorSearch"];
                ?>
            </h6>
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
                <div class="d-flex flex-column">
                    <!-- If we make this disabled it will make the button darker -->
                    <button id="adminlogo" class="btn btn-danger align-self-center" disabled>administrator</button>
                </div>
                <h5 class="text-light mt-5">bio</h5>
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
                        <a class="nav-item mx-1 text-center nav-link text-light" href="<?=BASE?>Profile/otherAnimeList/<?php echo $data["user"]->user_id; ?>">anime list</a>
                        <!-- Send Message -->
                        <a class="nav-item mx-1 text-center nav-link text-danger" href="<?=BASE?>Profile/otherSendMessage/<?php echo $data["user"]->user_id;?>">send messages</a>
                      </div>
                    </div>
                </nav>

                <!-- post, animelist, mangalist, and settings box -->
                <!-- The box where all the post, anime list, mangalist and settings will be placed -->
                <div id="listBox">
                    <div style="height: 280px;overflow: scroll;">
                        <table class="table">
                            <tbody>
                                <!-- Per message. We need to put a for loop then put this tr inside of it  -->
                                <!-- Place where to put the message and the time stamp -->
                                <?php
                                    $like = new \app\models\PostLike();
                                    foreach($data["posts"] as $userPost) {
                                        $likes = $like->getAllLikes($userPost->profile_post_id);
                                        $likeOrUnlikeHref;
                                        if ($like->isPostLiked($userPost->profile_post_id, $_SESSION["user_id"])) {
                                            $likeOrUnlikeHref = "<a class='links' href='/Profile/unLikePost/$userPost->profile_post_id/$userPost->user_id'>Unlike post</a>";
                                        }else if (!$like->isPostLiked($userPost->profile_post_id, $userPost->user_id)) {
                                            $likeOrUnlikeHref = "<a class='links' href='/Profile/likePost/$userPost->profile_post_id/$userPost->user_id'>Like post</a>";
                                        } 
                                        echo"<tr>
                                        <td class='text-light'> $userPost->post <br> $userPost->date {$likes['COUNT(*)']} Likes</td>
                                        <td>$likeOrUnlikeHref<td>
                                        </td>
                                      </tr>";
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