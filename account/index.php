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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <?php component::headFiles() ?>

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
                    <input type="text" name="username" autocomplete="off">
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="email" name="email" autocomplete="off">
                    <p class="placeholder">Email</p>
                </div>

                <div class="input">
                    <input type="password" name="password" data-type="password" autocomplete="off">
                    <p class="placeholder">Password</p>
                </div>

                <div class="input">
                    <input type="password" name="retry-password" data-type="password" autocomplete="off">
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
                <button class="login">
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
                    <input type="text" name="username" autocomplete="off">
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="password" name="password" data-type="password" autocomplete="off">
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

            <button class="forgot-password">
                Forgot Password
                <span class="effect-button"></span>
            </button>

            <div class="control center-item">
                <button class="signup">
                    Sign Up
                    <span class="effect-button"></span>
                </button>

                <button class="submit">
                    Submit
                    <span class="effect-button"></span>
                </button>
            </div>
        </div>
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
    ?>

    <script type="text/javascript" src="../share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>
