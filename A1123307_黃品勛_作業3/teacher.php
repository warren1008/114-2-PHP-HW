<?php
session_start();
if (!isset($_SESSION["login_status"]) || $_SESSION["role"] !== "teacher") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head><meta charset="UTF-8"><title>Teacher Page</title></head>
<body>
    <h1 style="color: green;">歡迎來到【教師專屬頁面】</h1>
    <p>老師您好，您目前的登入帳號是：<?php echo $_SESSION["username"]; ?></p>
    <a href="logout.php"><button>登出</button></a>
</body>
</html>