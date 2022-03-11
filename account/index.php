<?php require_once "../share/component.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" type="text/css" href="/share/form.css">
    <link rel="stylesheet" type="text/css" href="./responsive.css">

    <script>
        <?php
            # work on this code
            if (isset($_GET["login"]))
                echo "const flag = \"login\"";

            elseif (isset($_GET["signup"]))
                echo "const flag = \"signup\"";

            elseif (isset($_GET["information"]))
                echo "const flag = \"information\"";
        ?>
    </script>
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="center-item" id="signup-box">
            <img src="/images/register.svg" loading="lazy" alt="signup picture" draggable="false">

            <form action="" class="center-item">
                <div class="input">
                    <input type="text" name="firstName">
                    <p class="placeholder">First Name</p>
                </div>

                <div class="input">
                    <input type="text" name="username" required>
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="email" name="email" required>
                    <p class="placeholder">Email</p>
                </div>

                <ul>
                    <li>
                        use number, capitalize letter and specific character
                    </li>
                </ul>

                <div class="input">
                    <input type="password" name="password" data-type="password" required>
                    <p class="placeholder">Password</p>
                </div>

                <div class="input">
                    <input type="password" name="retry-password" data-type="password" required>
                    <p class="placeholder">Re-enter Password</p>
                </div>

                <input type="file" id="custom-profile" autocomplete="off">

                <input type="hidden" name="type" value="register">
            </form>

            <div class="show-password center-item">
                <input type="checkbox" id="show-password-signup" autocomplete="off">
                <label for="show-password-signup">Show Password</label>
            </div>

            <button class="profile">Select A Profile</button>

            <div class="profile-images center-item">
                <div class="center-item"></div>
                
                <div class="center-item"></div>
            </div>

            <img src="" alt="custom profile" draggable="false" id="custom-profile-image">

            <label for="custom-profile" class="center-item">Select A Custom Profile</label>

            <div class="control center-item">
                <button class="login" data-target-box="login">Login</button>

                <button class="submit">Submit</button>
            </div>
        </div>

        <div class="center-item" id="login-box">
            <img src="/images/login.svg" loading="lazy" alt="login picture" draggable="false">

            <form action="" class="center-item">
                <div class="input">
                    <input type="text" name="username" required>
                    <p class="placeholder">Username</p>
                </div>

                <div class="input">
                    <input type="password" name="password" data-type="password" required>
                    <p class="placeholder">Password</p>
                </div>

                <input type="hidden" name="type" value="login">
            </form>

            <div class="show-password center-item">
                <input type="checkbox" id="show-password-login" autocomplete="off">
                <label for="show-password-login">Show Password</p>
            </div>

            <button class="login-google">With Google</button>

            <button class="forgot-password" data-target-box="forgot">Forgot Password</button>

            <div class="control center-item">
                <button class="signup" data-target-box="signup">Sign Up</button>

                <button class="submit">Submit</button>
            </div>
        </div>

        <div class="center-item" id="forgot-password-box">
            <img src="/images/forgot-password.svg" loading="lazy" alt="forgot-password" draggable="flase">

            <form action="">
                <div class="input">
                    <input type="email" name="email" required>
                    <p class="placeholder">Email</p>
                </div>

                <input type="hidden" name="type" value="reset-password">
            </form>

            <div>
                <button class="submit">Take My Password</button>
            </div>
        </div>

        <div class="center-item" id="informations-box">
            <?php

                $type = substr($info["profile"], 0, strpos($info["profile"], ";"));
                $src = "data:$type;base64," . substr($info["profile"], strpos($info["profile"], ";") + 1);
                
            ?>

            <img src="<?php echo $src?? null ?>" loading="lazy" alt="user profile" draggable="false">
            <h2>Hey <span><?php echo $info["firstName"]?? "client" ?></span></h2>

            <button class="logout">Log out</button>

            <button class="change-info">Change Informations</button>
        </div>
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
        component::message();
        component::tooltip();
    ?>

    <script async type="text/javascript" src="/share/validate.js"></script>
    <script type="text/javascript" src="/share/app.js"></script>
    <script type="text/javascript" src="/share/form.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>
