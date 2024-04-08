<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- Google Icon Fonts -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- mobile optimization -->
    <link rel="stylesheet" href="scss/login.css">
    <title>Spotilist - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@500&display=swap" rel="stylesheet">

    <style>
        #img1,
        #img2,
        #img3 {
            width: 400px;
            height: 400px;
            top: 31.5%;
            left: 9.5%;
        }

        section {
            width: 250px;
            height: 625px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
        }

        p {
            text-align: center;
            font-family: 'Martian Mono', monospace;
        }

        h2 {
            text-align: center;
            font-family: 'Dancing Script', cursive;
        }

        span.field-icon {
            float: right;
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            z-index: 2;
        }

        body {
            background-image: url('images/loginpagebg.jpg');
        }

        #regtext {
            font-size: smaller;
        }
    </style>
</head>

<body class="indigo">
    <?php
    include("connection.php");
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $u_id = 0;
        //username and password sent from Form
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $sql = "SELECT id FROM accounts WHERE acc_email='$email' AND 
    acc_password ='$password'";

        if ($result = mysqli_query($con, $sql)) {
            //Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
                $u_id = $row["id"];
            }
        }

        if ($rowcount == 1) {
            $_SESSION['mySession'] = $username;
            $_SESSION['id'] = $u_id;

            // Check if the user is an admin
            if ($email === 'admin@gmail.com' && $password === 'admin123') {
                header("location: adminpage.php");
            } else {
                header("location: homepage.php");
            }
        } else {
            echo '<script>alert("Incorrect Password or Invalid Email Address. Please Re-Login.");window.location.href="login.php";</script>';
        }

        mysqli_close($con);
    }
    ?>
    <section class="section container z-depth-3 lime lighten-4" id="contact">
        <div class="row">
            <div class="col xl4 offset-xl1">
                <h2 class="indigo-text text-lighten-1">Spotilist</h2>
                <p>
                    Welcome to Spotilist.
                    Stats for Spotify.
                </p>
            </div>
            <div class="col xl4 offset-xl6" id="loginstuff">
                <form action="" method="post" class="indigo-text text-lighten-1">
                    <div class="input-field" id="theemail">
                        <i class="material-icons prefix">email</i>
                        <input type="email" name="email" id="email" required="required">
                        <label for="email">Enter your email</label>
                    </div>
                    <div class="input-field" id="thepassword">
                        <i class="material-icons prefix">password</i>
                        <input type="password" name="password" id="password" required="required">
                        <label for="password">Enter your password</label>
                        <span toggle="#password" class="field-icon toggle-password"><span
                                class="material-icons">visibility</span></span>
                    </div>
                    <div class="input-field col l6 offset-l4" id="forgotpass">
                        <a href="#!" class="red-text accent-1">Forgot your Password?</a>
                    </div>
                    <div class="input-field col l3 offset-l5" id="log">
                        <button type="submit" class="btn waves-effect waves-light indigo lighten-1">Login</button>
                    </div>
                    <div class="col l7 offset-l3" id="regtext">
                        <p>
                            Don't have an account? Register here!
                        </p>
                    </div>
                    <div class="input-field col l5 offset-l4" id="register">
                        <a href="register.html" class="btn waves-effect waves-light indigo lighten-1">Register
                            here!</a></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="imgwrapper">
            <img class="u-fadeCycle-1 z-depth-5" id="img1" src="images/alia1.webp">
            <img class="u-fadeCycle-2 z-depth-5" id="img2" src="images/mga1.jpg">
            <img class="u-fadeCycle-3 z-depth-5" id="img3" src="images/saucydog1.jpg">
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        var clicked = 0;

        $(".toggle-password").click(function (e) {
            e.preventDefault();

            $(this).toggleClass("toggle-password");
            if (clicked == 0) {
                $(this).html('<span class="material-icons">visibility_off</span >');
                clicked = 1;
            }
            else {
                $(this).html('<span class="material-icons">visibility</span >');
                clicked = 0;
            }

            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            }
            else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>