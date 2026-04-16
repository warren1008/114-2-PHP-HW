<?php
session_start();

if (isset($_POST['Item']) && isset($_POST['Quantity'])) {
    
    $item_id = $_POST['Item'];
    $qty = (int)$_POST['Quantity']; 
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); 
    }
    
    if (isset($_SESSION['cart'][$item_id])) {
        
        $_SESSION['cart'][$item_id] += $qty;
    } else {
        
        $_SESSION['cart'][$item_id] = $qty;
    }
}


header("Location: catalog.php");
exit;
?>