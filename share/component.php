<?php

    $connection = new PDO("mysql:host=127.0.0.1;dbname=shop", "matin", '!@MneZAMi#$2020');
    $info = [];

    if (!$connection)
        die("{\"status\": 500, \"message\": \"database isn't connect\"}");

    (function () {
        if (!isset($_COOKIE["token"]))
            return 0;
        
        $info = $GLOBALS["connection"]->prepare("SELECT * FROM `users` WHERE `token` = ?");
        $info->bindValue(1, $_COOKIE["token"]);
    
        if(!$info->execute())
            return 0;
    
        if ($info->rowCount())
            $GLOBALS["info"] = $info->fetch(PDO::FETCH_ASSOC);
    
        return 0;
    })();

    class component {
        static function navbar () {

?>

    <nav class="center-item">
        <template id="user">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <g fill="none" stroke="#FFF" stroke-width="7" stroke-linecap="round">
                    <circle cx="50" cy="25" r="20"/>
                    <path d="M 10 85 C 30 50 70 50 90 85"/>
                </g>
            </svg>
        </template>

        <div class="links center-item">
            <a href="/">Home</a>

            <a href="#">Products</a>
                 
            <a href="#">Cart</a>
        </div>

        <svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">                
            <rect class="menu-item" x="0" y="10"/>
            <rect class="menu-item" x="0" y="44"/>
            <rect class="menu-item" x="0" y="77"/>
        </svg>

        <div class="account center-item">
            <div id="profile"></div>

            <a href="/account?login">Log in</a>

            <span>/</span>

            <a href="/account?signup">Sign up</a>
        </div>
    </nav>

    <script>
        <?php echo "window.userProfile = \"" . ($GLOBALS["info"]["profile"]?? null) . "\";" ?>
    </script>

    <script type="text/javascript" src="/share/profile.js"></script>

<?php

        }

        static function asideMenu () {

?>

    <aside class="menu">
        <div class="links center-item">
            <a href="/">Home</a>
            <a href="#">Products</a>
            <a href="#">Cart</a>
        </div>
    </aside>

    <div id="prevent"></div>

<?php

        }

        static function search () {

?>

    <div class="search">
        <div>
            <input type="search" placeholder="Type to search..."  autocomplete="off">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <g fill="none" stroke="#000" stroke-width="4" stroke-linecap="round">
                    <circle cx="40" cy="40" r="25"/>
                    <line x1="58" y1="58" x2="80" y2="80"/>
                </g>
            </svg>
        </div>
    </div>

<?php

        }

        static function headFiles () {

?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2196F3">

    <link rel="dns-prefetch" href="http://localhost">

    <link rel="stylesheet" type="text/css" href="/share/responsive.css">
    <link rel="stylesheet" type="text/css" href="/share/style.css">

    <script type="text/javascript" src="/share/config.js"></script>

<?php

        }

        static function backToTop () {

?>

    <div class="center-item back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <path d="M 15 70 50 30 85 70" stroke="#FFF" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
    </div>

<?php

        }

        static function message () {

?>

    <div id="message">
        <p></p>
        <div class="progress"></div>
    </div>

<?php

        }

        static function tooltip () {

?>

    <div id="err-tooltip" class="center-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <polygon points="50 12 10 90 90 90" stroke-width="10" fill="#FFB703" stroke="#FFB703"/>
            <polygon points="50 1 14.7 70 75.1 50" fill="#FFF2"/>
            <path d="M 45 35 55 35 51 65 49 65 z" fill="#FFF" stroke-width="3" stroke="#FFF" stroke-linejoin="round"/>
            <circle cx="50" cy="73" r="4" fill="#FFF"/>
        </svg>

        <p></p>
    </div>

<?php

        }

    }

?>