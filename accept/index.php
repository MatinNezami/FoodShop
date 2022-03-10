<?php

    require_once "../share/component.php";
    $connection = connection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accept Account</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="/share/form.css">
    <link rel="stylesheet" type="text/css" href="/share/error.css">
    <link rel="stylesheet" type="text/css" href="/account/responsive.css">
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <?php
        component::backToTop();
        component::asideMenu();
        component::message();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>

    <main class="center-item">
        <?php

            if (isset($_GET["token"]) && $_GET["token"]) {
                $has = $connection->prepare("SELECT `token` FROM `users` WHERE `token` = ?");
                $has->bindValue(1, $_GET["token"]);
                
                $has->execute() or
                    die('<h2>query isn\'t exeucte <a href=".?token=' . $_GET["token"] . '">try again</a> or check your email</h2>');

                if (!$has->rowCount()) {

        ?>

            <img src="/images/500.svg" loading="lazy" alt="accept" draggable="false">
            <?php die ("<h2>token isn't valid</h2>"); } ?>

            <div class="center-item">
                <img src="/images/accept.svg" loading="lazy" alt="accept" draggable="false">

                <form action="" class="center-item">
                    <div class="input">
                        <input type="password" name="password" data-type="password" required>
                        <p class="placeholder">Password</p>
                    </div>
                </form>

                <div class="show-password center-item">
                    <input type="checkbox" id="show-password" autocomplete="off">
                    <label for="show-password">Show Password</p>
                </div>

                <button class="submit">Submit</button>
            </div>

            <script async type="text/javascript" src="/share/validate.js"></script>
            <script type="text/javascript" src="/share/form.js"></script>
            <script type="text/javascript" src="./main.js"></script>
        <?php } ?>
    </main>

    <?php component::tooltip() ?>
</body>

</html>