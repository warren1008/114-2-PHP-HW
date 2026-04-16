<?php
session_start();

$products = array(
    "S001" => array("name" => "10吋平板電腦", "price" => 12000),
    "S002" => array("name" => "15吋筆記型電腦", "price" => 28000),
    "S003" => array("name" => "智慧型手機", "price" => 15000)
);

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>我的購物車</title>
</head>
<body>
    <h2>🛒 您的購物車內容</h2>
    <hr>
    
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<table border='1' cellpadding='8'>";
    
        echo "<tr><th>商品名稱</th><th>單價</th><th>數量</th><th>小計</th><th>操作</th></tr>";
        
        foreach ($_SESSION['cart'] as $item_id => $qty) {
            $name = $products[$item_id]["name"];
            $price = $products[$item_id]["price"];
            $subtotal = $price * $qty;
            $total_price += $subtotal;
            
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>$" . number_format($price) . "</td>";
            echo "<td>" . $qty . "</td>";
            echo "<td>$" . number_format($subtotal) . "</td>";
            
            echo "<td><a href='delete.php?Id=" . $item_id . "'>刪除</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<h3 style='color: red;'>總計金額：$" . number_format($total_price) . "</h3>";
        
        echo "<p><a href='clear.php'><button style='color: red;'>🗑️ 清空購物車</button></a></p>";
    } else {
        echo "<p>您的購物車目前是空的喔！</p>";
    }
    ?>
    
    <hr>
    <a href="catalog.php"><button>繼續購物</button></a>
</body>
</html>