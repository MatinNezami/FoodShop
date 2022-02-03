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
        <div class="center-item">
            <div class="input">
                <input type="text" placeholder="Username" id="username">
                <label for="username" class="label">Username</label>
            </div>

            <div class="input">
                <input type="password" placeholder="Password" id="password">
                <label for="password">Password</label>
            </div>

            <div class="input">
                <input type="password" placeholder="Retry Password" id="retry-password">
                <label for="retry-password">Retry Password</label>
            </div>
        </div>
    </main>

    <?php component::asideMenu() ?>

    <script type="text/javascript" src="../share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>