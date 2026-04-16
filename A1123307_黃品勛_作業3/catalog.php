<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>商品型錄</title>
</head>
<body>
    <h2>🛍️ 網路購物商城 - 商品型錄</h2>
    <hr>
    
    <form action="savecart.php" method="POST">
        <p>
            <label for="item">選擇商品：</label>
            <select id="item" name="Item">
                <option value="S001">10吋平板電腦 - $12,000</option>
                <option value="S002">15吋筆記型電腦 - $28,000</option>
                <option value="S003">智慧型手機 - $15,000</option>
            </select>
        </p>
        <p>
            <label for="qty">數量：</label>
            <input type="number" id="qty" name="Quantity" value="1" min="1">
        </p>
        <button type="submit">🛒 加入購物車</button>
    </form>
    
    <hr>
    <a href="shoppingcart.php"><button>前往結帳 (查看購物車)</button></a>
</body>
</html>