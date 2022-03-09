<?php require_once "../share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Not Found</title>

    <?php component::headFiles() ?>
</head>

<body>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <img src="/images/404.svg" loading="lazy" alt="not found" draggable="false">

        <h2>
            This Location Is Not Exists Go To
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