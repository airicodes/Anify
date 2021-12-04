<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* To insert the Poppins font style */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        #body {
            background-color: #1E2336;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            height: 100%;
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


        #editProfileButton {
            width: 140px;
            margin-right: 10px;
        }

        #deleteProfileButton {
            margin-left: 8px;
        }

        /* Change the location of the second nav bar */
        #secondNavbar {
            margin-top: -2%;
        }

        /* Change the size the of nav item */
        #secondNavbar .navbar-nav .nav-item {
            font-size: 25px;
            width: 150px;
        }

        /* For the hovering effect of the second navbar */
        #secondNavbar .navbar-nav a:hover {
            color: #E168BF !important;
        }

        /* changing the color of the active nav item */
        #secondNavbar .navbar-nav a.active {
            background-color: #151929;
            border-radius: 25px;
        }

        /* the box where all the anime list and manga list are located */
        #listBox {
            background-color: rgba(3, 5, 13, 0.61);
            width: 1000px;
            height: max-content;
            border-radius: 25px;
            padding: 10px;
        }

        /* To change the position of the logo */
        #logo {
            width: 200px;
            margin-top: -0.2%;
        }

        .pfp {
            width: 60%;
        }

        .table-hover tbody a {
            text-decoration: none;
            color: inherit;
        }

        .table-hover tbody tr:hover td,
        .table-hover tbody tr:hover th {
            color: #E168BF;
        }

        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

/* The popup form - hidden by default */
.form-popup {
  display: none;
  border: 3px solid black;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 2px;
  margin-bottom:10px;
}


/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}


/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light" href="<?=BASE?>User/regularIndex">
            <h2>An<b id="fy">ify</b></h2>
        </a>
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
            <form class="d-flex justify-content-center">
                <button class="btn" id="searchButton" type="submit">
                    <!-- Adding the search icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search text-light" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search users/mangas/animes"
                    aria-label="Search">
            </form>
        </div>
    </nav>

    <!-- This for the actual body of the page -->
    <div class="container-xl container-fluid">
        <div class="row">
            <!-- the user information box -->
            <div id="userInformationBox" class="col-3 mt-5">
                <!-- Profile Picture -->
                <img class="rounded-circle mt-3 img-responsive center-block d-block mx-auto pfp"
                    src="<?php echo $data["profile"]->filename; ?>" data-rendered="true">
                <!-- Username -->
                <h2 class="text-center text-light mt-2"><?php echo $data["user"]->username; ?></h2>
                <!-- Edit and delete button -->
                <div class="mt-3 d-flex flex-row">
                    <form action="<?=BASE?>Profile/editProfileButton" method="POST">
                        <button name="editProfile" id="editProfileButton" type="submit"
                            class="btn btn-outline-info">Edit Profile</button>
                    </form>
                    <form action="<?=BASE?>User/deleteAccountButton" method="POST">
                        <button name="deleteAccount" id="deleteProfileButton" type="submit"
                            class="btn btn-outline-danger">Delete Account</button>
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
                <!-- The SECOND NAV BAR -->
                <nav id="secondNavbar" class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                            <!-- Posts -->
                            <a class="nav-item mx-1 text-center nav-link text-light"
                                href="<?=BASE?>User/regularIndex">posts</a>
                            <!-- Anime List -->
                            <a class="nav-item mx-1 text-center nav-link text-light active disabled">anime list</a>
                            <!-- Manga List -->
                            <a class="nav-item mx-1 text-center nav-link text-light"
                                href="<?=BASE?>User/regularMessages">messages</a>
                            <!-- Settings -->
                            <a class="nav-item mx-1 text-center nav-link text-light"
                                href="<?=BASE?>User/regularSettings">settings</a>
                        </div>
                    </div>
                </nav>

                <!-- post, animelist, mangalist, and settings box -->
                <!-- The box where all the post, anime list, mangalist and settings will be placed -->
                <div id="listBox">
                    <div class="container">
                        <div class="row">
                            <!-- This div is for the ALL ANIME TABLE -->
                            <div class="col-6 d-flex flex-column">
                                <h1 class="text-light text-center">All</h1>
                                <!-- To make a scrollable table -->
                                <div style="height: 468px;overflow: scroll;">
                                    <!-- The table itself -->
                                    <table class="table table-hover table-borderless text-light">
                                        <tbody>
                                            <!-- One row of the table. We need to put a for loop here so can can have multiple values -->
                                        <?php
                                        $star = "";
                                        foreach ($data["list"] as $anime) {
                                           if ($anime->favorite == 'y') {
                                               $star =  "/app/background/withstar.png";
                                           } else {
                                               $star =  "/app/background/nostar.png";
                                           }
                                          echo "<tr><td><a href='/User/regularEditAnimeList/$anime->anime_id'>" . $anime->anime_name . "</td>
                                           <td ><a href='/User/regularEditAnimeList/$anime->anime_id'>" . $anime->watching_status . "</a></td>
                                           <td><a  href='/User/regularEditAnimeList/$anime->anime_id'>" . $anime->rating . "</a></td>
                                           <td><a href='/User/addFavAnime/" . $anime->anime_id . "'><img src='" .
                                           $star . "' alt=''></a></td>
                                                       </tr>";

                                           echo "<div class='form-popup' id='myForm'>
                                           <form action='' class='form-container' method='POST'>
                                             <label for='status' style='color: white;'>Status</label>
                                           <select name='status' id='status'>
                                           <option value='Planning'>Planning</option>
                                           <option value='watching'>Watching</option>
                                             <option value='finished'>Finished</option>
                                             <option value='paused'>Paused</option>
                                             <option value='dropped'>Dropped</option>
                                           </select>
                                           <label for='rating' style='color: white;'>Status</label>
                                           <select name='rating' id='rating'>
                                             <option value='$anime->rating' selected>$anime->rating</option>
                                             <option value='1'>0</option>
                                             <option value='2'>1</option>
                                             <option value='3'>2</option>
                                             <option value='4'>3</option>
                                             <option value='5'>5</option>
                                             <option value='6'>6</option>
                                             <option value='7'>7</option>
                                             <option value='8'>8</option>
                                             <option value='9'>9</option>
                                             <option value='10'>10</option>
                                           </select>
                                           <br><br>
                                             <button type='submit' class='btn' name='action'>Confirm</button>
                                           </form>
                                         </div>";
                                       }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- This div is for the FAVOURITES -->
                            <div class="col-6 d-flex flex-column">
                                <h1 class="text-light text-center">Favorite</h1>
                                <!-- To make a scrollable table -->
                                <div style="height: 468px;overflow: scroll;">
                                    <!-- The table itself -->
                                    <table class="table table-hover table-borderless text-light">
                                        <tbody>
                                            <!-- One row of the table. We need to put a for loop here so can can have multiple values -->
                                            <?php
                                             foreach ($data["favlist"] as $favanime) {
                                               echo "<tr><td><p href=''>" . $favanime->anime_name . "</p></td>
                                                <td><p href=''>" . $favanime->watching_status . "</p></td>
                                                <td><p href=''>" . $favanime->rating . "</p></td>
                                                <td><p href=''><img src='\app/backgrounds/nostar.png' alt=''></p></td>
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
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="text-end mt-5 text-light">
            <img id="logo" src="/app/background/ProblemSolversLogo.png" alt="">
        </div>
    </footer>
    <script>
    function openForm() {
 if (document.getElementById("myForm").style.display == "block") {
    document.getElementById("myForm").style.display = "none";
 } else {
    document.getElementById("myForm").style.display = "block";
 }
}
</script>
</body>

</html>