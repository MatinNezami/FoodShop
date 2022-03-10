<?php require_once "../share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accept Account</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="/share/form.css">
    <link rel="stylesheet" type="text/css" href="/share/error.css">
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
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
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
        component::message();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>
    <script type="text/javascript" src="/share/form.js"></script>
</body>

</html>