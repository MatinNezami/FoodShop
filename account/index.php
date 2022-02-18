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
    <script async type="text/javascript" src="./validate.js"></script>

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
                    <input type="text" name="first-name">
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

                <div class="input">
                    <input type="password" name="password" data-type="password" required>
                    <p class="placeholder">Password</p>
                </div>

                <div class="input">
                    <input type="password" name="retry-password" data-type="password" required>
                    <p class="placeholder">Retry Password</p>
                </div>

                <input type="hidden" name="type" value="register">
            </form>

            <div class="show-password center-item">
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
            </div>

            <button class="profile">Select A Profile</button>

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
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
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
            <img src="/images/profile/1.webp" loading="lazy" alt="user profile" draggable="false">
            <h2>Hey <span>First Name Test Text</span></h2>

            <button class="logout">Log out</button>

            <button class="change-info">Change Informations</button>
        </div>
    </main>

    <div id="err-tooltip" class="center-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <polygon points="50 12 10 90 90 90" stroke-width="10" fill="#FFB703" stroke="#FFB703"/>
            <polygon points="50 1 14.7 70 75.1 50" fill="#FFF2"/>
            <path d="M 45 35 55 35 51 65 49 65 z" fill="#FFF" stroke-width="3" stroke="#FFF" stroke-linejoin="round"/>
            <circle cx="50" cy="73" r="4" fill="#FFF"/>
        </svg>

        <p></p>
    </div>

    <?php
        component::backToTop();
        component::asideMenu();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>
