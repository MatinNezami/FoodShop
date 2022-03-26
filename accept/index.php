<?php require_once "../share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accept Account</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="/share/form.css">
    <link rel="stylesheet" type="text/css" href="/share/error.css">
    <link rel="stylesheet" type="text/css" href="/account/responsive.css">

    <script>
        <?php echo "const client = {login: " . (isset($_COOKIE["token"])? "true": "false") . "};" ?>
    </script>
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div id="error" class="center-item" style="background-color: inherit;">
            <img src="/images/500.svg" loading="lazy" alt="accept" draggable="false">
            <h2>token isn't valid</h2>
        </div>

        <div id="accept-account" class="center-item">
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
        component::tooltip();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>
    <script async type="text/javascript" src="/share/validate.js"></script>
    <script type="text/javascript" src="/share/form.js"></script>
    <script type="text/javascript" src="./main.js"></script>

    <?php if (!isset($_GET["token"]) || ($_GET["token"] != $info["token"] && !$info["accep"])) { ?>
        <script>
            renderBox("error", false);
            history.replaceState(null, "", "?page=error");
        </script>
    <?php } ?>
</body>

</html>