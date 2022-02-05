<?php

    trait component {
        static function navbar () {

?>

    <nav class="center-item">
        <div class="links center-item">
            <p>
                <a href="/">
                    <span>Home</span>
                    <span class="animate"></span>
                </a>
            </p>
                        
            <p>
                <a href="#">
                    <span>Products</span>
                    <span class="animate"></span>
                </a>
            </p>
            
            <p>
                <a href="#">
                    <span>Cart</span>
                    <span class="animate"></span>
                </a>
            </p>
        </div>

        <svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">                
            <rect class="menu-item" x="0" y="10"/>
            <rect class="menu-item" x="0" y="44"/>
            <rect class="menu-item" x="0" y="77"/>
        </svg>

        <div class="account center-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <g fill="none" stroke="#FFF" stroke-width="7" stroke-linecap="round">
                    <circle cx="50" cy="25" r="20"/>
                    <path d="M 10 85 C 30 50 70 50 90 85"/>
                </g>
            </svg>

            <p>
                <a href="/account?login">
                    <span>Log in</span>
                    <span class="animate"></span>
                </a>
            </p>

            <span>/</span>

            <p>
                <a href="/account?signup">
                    <span>Sign up</span>
                    <span class="animate"></span>
                </a>
            </p>
        </div>
    </nav>

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

    <link rel="dns-prefetch" href="http://localhost">

    <link rel="stylesheet" type="text/css" href="/share/responsive.css">
    <link rel="stylesheet" type="text/css" href="/share/style.css">

    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" type="text/css" href="./responsive.css">

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
    }

?>