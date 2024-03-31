<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <style>
        .product, .cart {
            border-style: solid;
            border-color: black;
            border-width: 2px;
        }

        .cart {
            padding: 2rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="product">
            <form action="/process.php" method="post">
                <!-- <img src="" alt=""> -->
                <input type="hidden" name="id" value="1" />
                <input type="hidden" name="name" value="Z Flip Foldable Mobile" />
                <input type="hidden" name="price" value="120.00" />
                <input type="hidden" name="action" value="add" />
                <h3>Z Flip Foldable Mobile</h3>
                <h3>$ 120.00</h3>
                <button type="submit">Add to cart</button>
            </form>
        </div>
        <div class="product">
            <form action="/process.php" method="post">
                <!-- <img src="" alt=""> -->
                <input type="hidden" name="id" value="2" />
                <input type="hidden" name="name" value="Air Pods Pro" />
                <input type="hidden" name="price" value="60.00" />
                <input type="hidden" name="action" value="add" />
                <h3>Air Pods Pro</h3>
                <h3>$ 60.00</h3>
                <button type="submit">Add to cart</button>
            </form>
        </div>
        <div class="product">
            <form action="/process.php" method="post">
                <!-- <img src="" alt=""> -->
                <input type="hidden" name="id" value="3" />
                <input type="hidden" name="name" value="Headphones" />
                <input type="hidden" name="price" value="100.00" />
                <input type="hidden" name="action" value="add" />
                <h3>Headphones</h3>
                <h3>$ 100.00</h3>
                <button type="submit">Add to cart</button>
            </form>
        </div>

        <div class="cart">
            <h1>My Cart:</h1>
            
            <?php
            if (isset($_SESSION['cart'])):
                foreach ($_SESSION['cart'] as $product):
            ?>
            
                <div class="product">
                    <form action="/process.php" method="post">
                        <!-- <img src="" alt=""> -->
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
                        <input type="hidden" name="action" value="remove" />
                        <h3><?php echo $product['name'] ?></h3>
                        <h3>$ <?php echo $product['price'] ?></h3>
                        <button type="submit">Remove from cart</button>
                    </form>
                </div>

            <?php 
                endforeach;
            endif;
            ?>

            <h3 class="total">Total:  $ <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : "0.00" ?></h3>
        </div>
    </div>


</body>
</html>