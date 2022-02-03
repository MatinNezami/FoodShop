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
                    <p>Woman's Dress</p>
                    <p>120000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product2.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Winter Hat</p>
                    <p>160000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product3.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Woman's Pants</p>
                    <p>140000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product4.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Summer Hat</p>
                    <p>100000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product5.jpeg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Smart Watch</p>
                    <p>230000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product6.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Sport Shoe</p>
                    <p>80000</p>
                </div>
            </a>
        </div>


        <div class="aside-products-box">
            <div class="left center-item">
                <a href="#" class="aside-product left center-item">
                    <div class="info center-item">
                        <p>Sunglasses</p>
                        <p>300000</p>
                    </div>
        
                    <img src="./images/product7.jpg" alt="product picture">
                </a>
            </div>

            <div class="right center-item">
                <a href="#" class="aside-product right center-item">
                    <img src="./images/product8.jpg" alt="product picture">
                    
                    <div class="info center-item">
                        <p>T Shirt</p>
                        <p>60000</p>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <?php component::asideMenu() ?>

    <footer class="center-item">
        <img src="./images/post2.jpg" alt="background picture">
        <img src="./images/post3.jpg" alt="background picture">

        <div class="products-box center-item">
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product9.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>T Shirt</p>
                    <p>50000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product10.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Man Shoe</p>
                    <p>320000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product11.jpeg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Sunglasses</p>
                    <p>20000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product12.webp" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Woman's Shoe</p>
                    <p>90000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product13.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Scarf</p>
                    <p>18000</p>
                </div>
            </a>
    
            <a href="#" class="product center-item">
                <div class="image">
                    <img src="./images/product14.jpg" alt="product picture">
                </div>
    
                <div class="info center-item">
                    <p>Gloves</p>
                    <p>8000</p>
                </div>
            </a>
        </div>
    </footer>

    <script type="text/javascript" src="./share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>