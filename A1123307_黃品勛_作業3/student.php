<?php
session_start();

if (!isset($_SESSION["login_status"]) || $_SESSION["role"] !== "student") {
    header("Location: login.php");
    exit;
}

$cookie_id = isset($_COOKIE["UserID"]) ? $_COOKIE["UserID"] : "No Cookie Found";
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Student Page</title>
</head>
<body>
    <h1 style="color: blue;">歡迎來到【學生專屬頁面】</h1>
    <hr>
    <p>您的登入身分是：<strong><?php echo $_SESSION["role"]; ?></strong></p>
    <p>Session 中的帳號：<strong><?php echo $_SESSION["username"]; ?></strong></p>
    <p>Cookie 中的 ID：<strong><?php echo htmlspecialchars($cookie_id); ?></strong></p>
    
    <hr>
    <a href="logout.php"><button>登出系統 (清除 Session)</button></a>
    <a href="delete_cookie.php"><button>刪除 Cookie ID</button></a>
</body>
</html>