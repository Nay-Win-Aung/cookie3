<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Cookie Tracking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>E-commerce Cookie Tracking</h1>
        <?php
        // Initialize cart array
        $cart = [];

        // Check if the cart cookie exists
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        }

        // Process add-to-cart action
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $cart[$product_id] = isset($cart[$product_id]) ? $cart[$product_id] + 1 : 1;
            setcookie('cart', json_encode($cart), time() + 86400, '/');
        }

        // Product list
        $products = [
            ['id' => 1, 'name' => 'Product 1', 'price' => 10],
            ['id' => 2, 'name' => 'Product 2', 'price' => 20],
            ['id' => 3, 'name' => 'Product 3', 'price' => 30],
        ];

        // Display products
        foreach ($products as $product) {
            echo '<div class="product">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<p>Price: $' . $product['price'] . '</p>';
            echo '<form method="post">';
            echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
            echo '<button type="submit">Add to Cart</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
        <h2>Cart</h2>
        <?php
        // Display cart contents
        foreach ($cart as $product_id => $quantity) {
            $product = $products[$product_id - 1]; // Assuming product IDs start from 1
            echo '<p>' . $product['name'] . ' (Qty: ' . $quantity . ')</p>';
        }
        ?>
    </div>
</body>
</html>
