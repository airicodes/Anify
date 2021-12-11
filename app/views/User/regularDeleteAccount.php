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

            /* The code that do the animation */
            animation: animate 30s ease-in-out infinite backwards;

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
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        /*  The design of the box in the middle */
        #loginBox {
            width: 650px;
            height: 400px;
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
            margin-top: 10%;
            padding-left: 30px;
            padding-right: 30px;
        }
        
        /* To change the color, radius and the margin top of the log in button */
        #loginButton {
            /* background-color: red; */
            width: 120%;
            border-radius: 15px;
            margin-left: 250%;
            margin-top: 39%;
            padding-right: 60%;
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

        #about {
            width: 100%;
            height: 100%;
        }

        #invisible {
            width:85%;
            height:85%
        }

        .boutens {
            float: left;
            margin-left: 22%;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body id="body">
    <!-- This is for the navbar -->
    <nav class="navbar navbar-expand-lg p-3">
        <a class="navbar-brand text-light"href="<?=BASE?>User/regularIndex"><h2>An<b id="fy">ify</b></h2></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- To go to ABOUT PAGE -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?=BASE?>User/regularAbout">about</a>
                </li>
                <li class="nav-item">
                    <!-- To go to the regular browse page -->
                    <a class="nav-link text-light" href="<?=BASE?>User/regularBrowse">browse</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="center">
        <h1 id="websiteName" class="text-light text-center">An<b id="ify">ify</b></h1>
        <div id="loginBox" class="mx-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mt-3" id="go-down">
                                <h1 class="text-light">Delete Account</h1>
                                <h2 class="text-light">Are you sure?</h1>
                                <br>
                                <h3 class="text-light">By clicking Delete, you are agreeing to permanently deleting your account. It is impossible to retrieve after completing this action...</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <center>
            <form action="" method="POST">
                <button name="cancel" type="submit" class="btn btn-outline-secondary btn-lg boutens">Cancel</button>
            </form> 
            <form action="" method="POST">
                <button name="delete" type="submit" class="btn btn-outline-danger btn-lg boutens">Delete</button>
            </form>
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