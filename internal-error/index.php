<?php require_once "../share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Not Found</title>

    <?php component::headFiles() ?>
    <link rel="stylesheet" type="text/css" href="/share/error.css">
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <img src="/images/500.svg" loading="lazy" alt="not found" draggable="false">

        <h2>
            Oops Server Error Go To
            <a href="/">Home</a>
        </h2>
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
    ?>

    <script type="text/javascript" src="/share/app.js"></script>
</body>

</html>