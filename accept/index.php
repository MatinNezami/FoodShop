<?php require_once "../share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accept</title>

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
                <input type="checkbox" id="show-accept-account" autocomplete="off">
                <label for="show-accept-account">Show Password</p>
            </div>

            <button class="submit">Submit</button>
        </div>

        <div id="accept-code" class="center-item">
            <img src="/images/accept-code.svg" loading="lazy" alt="accept code" draggable="false">

            <form action="" class="center-item">
                <ul>
                    <li>enter only number</li>
                </ul>

                <div class="tiny-inputs center-item">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                    <input type="text" name="number" min="0" max="9" maxlength="1">
                </div>

                <div class="input">
                    <input type="password" data-type="password" name="password" required>
                    <p class="placeholder">New Password</p>
                </div>
                
                <div class="input">
                    <input type="password" data-type="password" name="retry-password" required>
                    <p class="placeholder">Re-enter Password</p>
                </div>
            </form>

            <div class="show-password">
                <input type="checkbox" id="show-accept-code" autocomplete="off">
                <label for="show-accept-code">Show Password</label>
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

    <?php if (!isset($_GET["token"]) || ($_GET["token"] != $info["token"] && !$info["accept"])) { ?>
        <script>
            renderBox("error", false);
            history.replaceState(null, "", "?page=error");
        </script>
    <?php } ?>
</body>

</html>