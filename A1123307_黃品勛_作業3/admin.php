<?php
session_start();
if (!isset($_SESSION["login_status"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head><meta charset="UTF-8"><title>Admin Page</title></head>
<body>
    <h1 style="color: red;">⚠️ 進入【最高權限管理者後台】</h1>
    <p>管理員 ID：<?php echo $_SESSION["username"]; ?></p>
    <a href="logout.php"><button>登出</button></a>
</body>
</html>