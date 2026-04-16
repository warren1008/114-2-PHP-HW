
<?php
session_start();

$remembered_id = isset($_COOKIE["UserID"]) ? $_COOKIE["UserID"] : "";
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>作業3 - 系統登入</title>
</head>
<body>
    <h2>系統登入 (結合 Session 與 Cookie)</h2>
    <hr>
    <form action="check_login.php" method="POST">
        <p>
            <label for="username">使用者帳號 (ID)：</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($remembered_id); ?>" required>
        </p>
        <p>
            <label for="password">使用者密碼：</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <label for="role">登入身分：</label>
            <select id="role" name="role">
                <option value="student">學生 (Student)</option>
                <option value="teacher">教師 (Teacher)</option>
                <option value="admin">管理者 (Admin)</option>
            </select>
        </p>
        <p>
            <input type="checkbox" id="remember" name="remember" value="yes">
            <label for="remember">記住我的帳號 (Cookie)</label>
        </p>
        <button type="submit">確認登入</button>
    </form>
</body>
</html>