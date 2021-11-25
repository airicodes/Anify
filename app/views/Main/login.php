<!DOCTYPE html>
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
            height: 450px;
            background-color: #03050D;
            border-radius: 25px;
            opacity: 80%;
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
        }
        
        /* To change the color, radius and the margin top of the log in button */
        #loginButton {
            background-color: #e168bf;
            width: 400px;
            border-radius: 15px;
            margin-top: 8%;
        }


        @keyframes animate{
            0%, 100%{
                background: url(/app/background/background1.png) no-repeat center center fixed; 
                /* To make sure that the bg fits on the screen */
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: 102%;
            }

            25%{
                background: url(/app/background/background2.png) no-repeat center center fixed; 
                /* To make sure that the bg fits on the screen */
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: 102%;
            }

            50%{
                background: url(/app/background/background3.png) no-repeat center center fixed; 
                /* To make sure that the bg fits on the screen */
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: 102%;
            }
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="body">
    <img id="problemSolversImage" class="mt-2 mx-1" src="/background/ProblemSolversLogo.png" alt="">


    <div id="center">
        <h1 id="websiteName" class="text-light text-center">An<b id="ify">ify</b></h1>
        <div id="loginBox" class="mx-4"> 
            <div class="text-center">
                <!-- Where the user input his username -->
                <input class="input" type="text" name="username" placeholder="username">
                <!-- Where the user input his password -->
                <input class="input" type="text" name="password" placeholder="password">
                <br>
                <button id="loginButton" type="button" class="btn btn-secondary btn-lg">Login</button>
                <br>
                <br>
                <!-- A link to create an account -->
                <a class="text-decoration-none text-light" href="#">Create an account</a>
                <br>
                <!-- A link for forgot password -->
                <a class="text-decoration-none text-light" href="#">Forgot password</a>
            </div>
        </div>
    </div>
</body>
</html>