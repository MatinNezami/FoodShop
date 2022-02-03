<?php
    
    require_once "../share/component.php";

    function profile (int $index) {
        $length = $index + 3;
        for ($index; $index <= $length; $index++) {
            if ($index % 2 == 0)
                echo '<img src="/images/profile/profile' . $index . '.jpeg" alt="profile" draggable="false"></div>';

            else
                echo '<div class="center-item"><img src="/images/profile/profile' . $index . '.jpeg" alt="profile" draggable="false">';
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
</head>

<body>
    <!-- <img src="../images/account.jpg" alt="background picture"> -->
    <div></div>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="center-item" id="register-box">
            <img src="/images/register.jpg" alt="register picture" draggable="false">

            <div class="input">
                <input type="text" class="username">
                <p data-text="Username" class="placeholder">Username</p>
            </div>

            <div class="input">
                <input type="password" class="password">
                <p data-text="Password" class="placeholder">Password</p>
            </div>

            <div class="input">
                <input type="password" class="retry-password">
                <p data-text="Retry Password" class="placeholder">Retry Password</p>
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
                <button class="login">Login</button>
                <button class="submit">Submit</button>
            </div>
        </div>
    </main>

    <?php component::asideMenu() ?>

    <script type="text/javascript" src="../share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>