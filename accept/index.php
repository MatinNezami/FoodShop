<?php

    require_once "../share/component.php";

    $token = getInfo($_GET["token"]?? 0);
    
    $client = [];
    $acceptCode = $_GET["page"] == "reset-password" && !$token["acceptCode"];

    if (time() > $token["oppertunity"])
        $client["box"] = "resend-email";
    
    elseif ($token["accept"] && $_GET["page"] == "accept-account")
        $client["box"] = "accepted";
    
    elseif (!isset($_GET["token"]) || $_GET["token"] != $token["token"] || $acceptCode)
        $client["box"] = "error";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accept</title>

    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="/share/form.css">
    <link rel="stylesheet" type="text/css" href="/share/error.css">
    <link rel="stylesheet" type="text/css" href="/account/responsive.css">

    <script>
        <?php echo "const client = " . json_encode($client) . ";" ?>
    </script>
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div id="error" class="center-item static-box">
            <img src="/images/500.svg" loading="lazy" alt="error" draggable="false">
            <h2>Token invalid</h2>
        </div>

        <div id="accepted" class="center-item static-box">
            <img src="/images/accepted.svg" loading="lazy" alt="accepted" draggable="false">
            <h2>Account is accepted</h2>
        </div>

        <div id="accept-account" class="center-item">
            <img src="/images/accept.svg" loading="lazy" alt="accept" draggable="false">

            <form action="" class="center-item">
                <div class="input">
                    <input type="password" name="password" check="password" data-type="password" required>
                    <p class="placeholder">Password</p>
                </div>
            </form>

            <div class="show-password center-item">
                <input type="checkbox" id="show-accept-account" autocomplete="off">
                <label for="show-accept-account">Show Password</p>
            </div>

            <button class="submit">Submit</button>
        </div>

        <div id="reset-password" class="center-item">
            <img src="/images/accept-code.svg" loading="lazy" alt="accept code" draggable="false">

            <form action="" class="center-item" details-error>
                <ul>
                    <li>Enter only number</li>
                </ul>

                <div class="tiny-inputs center-item">
                    <input type="text" check="number" min="0" max="9" required>
                    <input type="text" check="number" min="0" max="9" required>
                    <input type="text" check="number" min="0" max="9" required>
                    <input type="text" check="number" min="0" max="9" required>
                    <input type="text" check="number" min="0" max="9" required>
                    <input type="text" check="number" min="0" max="9" required>
                </div>

                <div class="input">
                    <input type="password" data-type="password" check="password" name="password" required>
                    <p class="placeholder">New Password</p>
                </div>
                
                <div class="input">
                    <input type="password" data-type="password" name="retry-password" retype="password" required>
                    <p class="placeholder">Re-enter Password</p>
                </div>

                <input type="hidden" name="type" value="accept-code">
            </form>

            <div class="show-password">
                <input type="checkbox" id="show-reset-password" autocomplete="off">
                <label for="show-reset-password">Show Password</label>
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
</body>

</html>