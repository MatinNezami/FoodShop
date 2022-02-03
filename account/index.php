<?php require_once "../share/component.php" ?>

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
                <input type="text" placeholder="Username" class="username">
                <p><span>*</span> Username</p>
            </div>

            <div class="input">
                <input type="password" placeholder="Password" class="password">
                <p><span>*</span> Password</p>
            </div>

            <div class="input">
                <input type="password" placeholder="Retry Password" class="retry-password">
                <p><span>*</span> Retry Password</p>
            </div>
        </div>
    </main>

    <?php component::asideMenu() ?>

    <script type="text/javascript" src="../share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>