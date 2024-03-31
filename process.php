<?php
    session_start();

    /**
     * Adds product to cart
     * 
     * @param product array
     * @return void
     */
    function addToCart($product) {
        // Filters & Formats
        $product['name'] = trim($product['name']);
        $product['name'] = stripslashes($product['name']);
        $product['name'] = htmlspecialchars($product['name']);
        $product['price'] = (double) $product['price'];
        
        // Add product to cart if product is not yet added
        if (!isset($_SESSION['cart'][$product['id']])) {
            // Add new product to cart
            $_SESSION['cart'][$product['id']] = $product;
            
            // Update total price
            $_SESSION['total'] += $_POST['price'];
        }
    }


    /**
     * Removes product from cart given the id
     * 
     * @param id int
     * @return void
     */
    function removeFromCart($id) {
        // Remove product from cart if found
        if (isset($_SESSION['cart'][$id])) {
            $product = $_SESSION['cart'][$id];
            
            // Remove product from cart
            unset($_SESSION['cart'][$id]);

            // Update total price
            $_SESSION['total'] -= $product['price'];
        }
    }


    /**
     * Removes all products from cart
     * 
     * @return void
     */
    function emptyCart() {
        unset($_SESSION['cart']);
        $_SESSION['total'] = 0;
    }





    if (isset($_POST['action'])) {
        // Add specific product to cart
        if ($_POST['action'] === "add") {
            // Validations
            if (!isset($_POST['name']) || !is_string($_POST['name'])) {
                header("Location: index.php");
                exit;
            }
            if (!isset($_POST['price']) || !is_numeric($_POST['price']) || (is_numeric($_POST['price']) && $_POST['price'] < 0)) {
                header("Location: index.php");
                exit;
            }

            $product = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price']
            ];
            addToCart($product);
        }
    
        // Remove specific product from cart
        if ($_POST['action'] === "remove") {
            if (isset($_POST['id'])) {
                removeFromCart($_POST['id']);
            }
        }

        // Remove all products from cart
        if ($_POST['action'] === "empty") {
            emptyCart();
        }

        
        unset($_SESSION['action']);
        header("Location: index.php");
    }
?>