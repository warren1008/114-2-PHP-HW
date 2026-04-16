<?php
session_start();

if (isset($_GET['Id'])) {
    $remove_id = $_GET['Id'];
    
    
    if (isset($_SESSION['cart'][$remove_id])) {
        
        unset($_SESSION['cart'][$remove_id]);
    }
}

header("Location: shoppingcart.php");
exit;
?>