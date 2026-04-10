<?php
// 啟動 Session 
session_start();

$error_msg = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // 驗證帳號與密碼
    if ($username === "admin" && $password === "1234") {
        // 登入成功
        header("Location: camp_form.html");
        exit;
    } else {
        // 登入失敗：設定錯誤訊息
        $error_msg = "登入失敗：帳號或密碼錯誤，請重新輸入！";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>夏令營 - 登入系統</title>
</head>
<body>
    <h2>2026 夏令營報名系統 - 登入</h2>
    <hr>
    
    <?php if ($error_msg != ""): ?>
        <p style="color: red; font-weight: bold;"><?php echo $error_msg; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <p>
            <label for="username">管理員帳號：</label>
            <input type="text" id="username" name="username" required>
        </p>
        <p>
            <label for="password">管理員密碼：</label>
            <input type="password" id="password" name="password" required>
        </p>
        <button type="submit">登入</button>
    </form>
</body>
</html>