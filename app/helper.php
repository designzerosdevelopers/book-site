<?php
// Check if the 'cart' cookie is set
if (isset($_COOKIE['cart'])) {
    // Decode the 'cart' cookie
    $cart = json_decode($_COOKIE['cart'], true);
  
    // Check if decoding was successful
    if ($cart !== null) {
        print_r($cart); // Display the contents of the $cart array
    } else {
        echo "Error decoding the 'cart' cookie.";
    }
} else {
    echo "The 'cart' cookie is not set.";
}
?>
