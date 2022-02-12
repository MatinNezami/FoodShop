<?php require_once "./share/component.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    
    <?php component::headFiles() ?>
</head>

<body>
    <header>
        <img src="./images/post1.jpg" alt="background picture">

        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="products-box center-item">
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product1.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Dress</strong>
                    <p>120000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product2.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Winter Hat</strong>
                    <p>160000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product3.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Pants</strong>
                    <p>140000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product4.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Summer Hat</strong>
                    <p>100000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product5.jpeg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Smart Watch</strong>
                    <p>230000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product6.webp" alt="product picture">
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
            
                        <img src="./images/product7.jpg" alt="product picture">
                    </a>
                </div>

                <div class="right center-item">
                    <a href="#" class="aside-product right center-item">
                        <img src="./images/product8.jpg" alt="product picture">
                        
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
                            <img src="./images/product16.jpg" alt="product picture">

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
                            <img src="./images/product15.jpg" alt="product picture">

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
        <img src="./images/post2.jpg" alt="background picture">
        <img src="./images/post3.jpg" alt="background picture">

        <div class="products-box center-item">
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product9.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>T Shirt</strong>
                    <p>50000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product10.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Man Shoe</strong>
                    <p>320000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product11.jpeg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Sunglasses</strong>
                    <p>20000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product12.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Woman's Shoe</strong>
                    <p>90000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product13.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Scarf</strong>
                    <p>18000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product14.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <strong>Gloves</strong>
                    <p>8000</p>
                </div>
            </a>
        </div>
    </footer>

    <script type="text/javascript" src="./share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>