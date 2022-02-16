<?php require_once "./share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Template</title>
    
    <?php component::headFiles() ?>

    <link rel="stylesheet" type="text/css" href="./responsive.css">
</head>

<body>
    <header>
        <img src="/images/post1.webp" alt="background picture">

        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="products-box center-item">
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/1.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Dress</strong>
                    <p>120000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/2.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Winter Hat</strong>
                    <p>160000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/3.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Pants</strong>
                    <p>140000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/4.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Summer Hat</strong>
                    <p>100000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/5.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Smart Watch</strong>
                    <p>230000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/6.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Sport Shoe</strong>
                    <p>80000</p>
                </div>
            </a>
        </div>


        <div class="effect-products-box">
            <div class="desktop center-item">
                <div class="left center-item">
                    <a href="#" class="aside-product left center-item">
                        <div class="info center-item">
                            <strong>Sunglasses</strong>
                            <p>300000</p>
                        </div>
            
                        <img src="/images/product/7.webp" loading="lazy" alt="product picture" draggable="false">
                    </a>
                </div>

                <div class="right center-item">
                    <a href="#" class="aside-product right center-item">
                        <img src="/images/product/8.webp" loading="lazy" alt="product picture" draggable="false">
                        
                        <div class="info center-item">
                            <strong>T Shirt</strong>
                            <p>60000</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mobile center-item">
                <div class="center-item">
                    <a href="#" class="hide-product center-item">
                        <div class="image">
                            <img src="/images/product/16.webp" loading="lazy" alt="product picture" draggable="false">

                            <div class="info center-item">
                                <strong>Nike</strong>
                                <p>300000</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="center-item">
                    <a href="#" class="hide-product center-item">
                        <div class="image">
                            <img src="/images/product/15.webp" loading="lazy" alt="product picture" draggable="false">

                            <div class="info center-item">
                                <strong>Tennis Hat</strong>
                                <p>15000</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <?php
        component::backToTop();
        component::asideMenu();
    ?>

    <footer class="center-item">
        <picture>
            <source media="(max-width: 1108px)" srcset="/images/post3.webp">
            <img src="/images/post2.webp" alt="background picture">
        </picture>

        <div class="products-box center-item">
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/9.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>T Shirt</strong>
                    <p>50000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/10.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Man Shoe</strong>
                    <p>320000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/11.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Sunglasses</strong>
                    <p>20000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/12.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Shoe</strong>
                    <p>90000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/13.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Scarf</strong>
                    <p>18000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="/images/product/14.webp" loading="lazy" alt="product picture" draggable="false">
                </div>
    
                <div class="info center-item">
                    <strong>Gloves</strong>
                    <p>8000</p>
                </div>
            </a>
        </div>
    </footer>

    <script type="text/javascript" src="/share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>
