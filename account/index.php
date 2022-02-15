<?php
    
    require_once "../share/component.php";

    function profile (int $index) {
        $length = $index + 3;
        for ($index; $index <= $length; $index++) {
            if ($index % 2 == 0)
                echo '<img src="/images/profile/' . $index . '.webp" alt="profile" draggable="false"></div>';

            else
                echo '<div class="center-item"><img src="/images/profile/' . $index . '.webp" alt="profile" draggable="false">';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="./responsive.css">

    <script>
        <?php
            if (isset($_GET["login"]))
                echo "const flag = \"login\"";

            elseif (isset($_GET["signup"]))
                echo "const flag = \"signup\"";

            elseif (isset($_GET["information"]))
                echo "const flag = \"info\"";
        ?>
    </script>
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="center-item" id="signup-box">
            <img src="/images/register.svg" alt="signup picture" draggable="false">

            <form action="" class="center-item">
                <div class="input">
                    <input type="text" name="username">
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="email" name="email">
                    <p class="placeholder">Email</p>
                </div>

                <div class="input">
                    <input type="password" name="password" data-type="password">
                    <p class="placeholder">Password</p>
                </div>

                <div class="input">
                    <input type="password" name="retry-password" data-type="password">
                    <p class="placeholder">Retry Password</p>
                </div>
            </form>

            <div class="show-password center-item">
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
            </div>

            <button class="profile">
                Select A Profile
                <span class="effect-button"></span>
            </button>

            <div class="profile-images center-item">
                <div class="center-item">
                    <?php profile(1) ?>
                </div>

                <div class="center-item">
                    <?php profile(5) ?>
                </div>
            </div>

            <input type="file" id="custom-profile">

            <img src="" alt="custom profile" draggable="false" id="custom-profile-image">

            <label for="custom-profile" class="center-item">
                Select A Custom Profile
                <span class="effect-button"></span>
            </label>

            <div class="control center-item">
                <button class="login" data-target-box="login">
                    Login
                    <span class="effect-button"></span>
                </button>

                <button class="submit">
                    Submit
                    <span class="effect-button"></span>
                </button>
            </div>
        </div>

        <div class="center-item" id="login-box">
            <img src="/images/login.svg" alt="login picture" draggable="false">

            <form action="" class="center-item">
                <div class="input">
                    <input type="text" name="username">
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="password" name="password" data-type="password">
                    <p class="placeholder">Password</p>
                </div>
            </form>

            <div class="show-password center-item">
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
            </div>

            <button class="login-google">
                With Google
                <span class="effect-button"></span>
            </button>

            <button class="forgot-password" data-target-box="forgot">
                Forgot Password
                <span class="effect-button"></span>
            </button>

            <div class="control center-item">
                <button class="signup" data-target-box="signup">
                    Sign Up
                    <span class="effect-button"></span>
                </button>

                <button class="submit">
                    Submit
                    <span class="effect-button"></span>
                </button>
            </div>
        </div>

        <div class="center-item" id="forgot-password-box">
            <img src="/images/forgot-password.svg" alt="forgot-password" draggable="flase">

            <form action="">
                <div class="input">
                    <input type="email" name="email">
                    <p class="placeholder">Email</p>
                </div>
            </form>

            <button class="submit">
                Take My Password
                <span class="effect-button"></span>
            </button>
        </div>

        <div class="center-item" id="informations-box">
            <img src="images/profile/1.webp" alt="user profile" draggable="false">
            <h2>Hey <p>First Name</p></h2>
        </div>
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>
