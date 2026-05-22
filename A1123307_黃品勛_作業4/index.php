<?php

$host = 'localhost';
$db   = 'spam_system';
$user = 'root'; 
$pass = '';    

try {
  
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM emails ORDER BY id DESC");
    $email_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("資料庫連線失敗：" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>垃圾郵件發送管理系統</title>
    <style>
        body { font-family: "微軟正黑體", Arial, sans-serif; background-color: #f4f6f9; color: #333; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #2c3e50; }
        h2 { border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; color: #34495e; font-size: 1.2rem; margin-top: 30px; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], select, textarea {
            width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
        }
        button { background-color: #3498db; color: #fff; border: none; padding: 10px 15px; font-size: 16px; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background-color: #2980b9; }
        .btn-orange { background-color: #e67e22; }
        .btn-orange:hover { background-color: #d35400; }
        ul.email-list { background: #f9f9f9; border: 1px solid #ddd; padding: 15px 30px; border-radius: 4px; max-height: 200px; overflow-y: auto; }
        ul.email-list li { margin-bottom: 5px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📨 郵件發送管理系統</h1>

        <h2>1. 新增 Email 名單</h2>
        <form action="send.php" method="POST">
            <input type="hidden" name="action" value="add_email">
            <div class="form-group">
                <label>Email：</label>
                <input type="email" name="email" required placeholder="例如：user@example.com">
            </div>
            <button type="submit">加入資料庫</button>
        </form>

        <h2>2. 目前資料庫名單 (總計: <?php echo count($email_list); ?> 筆)</h2>
        <?php if(count($email_list) > 0): ?>
            <ul class="email-list">
                <?php foreach ($email_list as $row): ?>
                    <li><?php echo htmlspecialchars($row['email']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: gray;">目前尚無資料，請由上方新增。</p>
        <?php endif; ?>

        <h2>3. 寄送電子報與發信設定</h2>
        <form action="send.php" method="POST" target="_blank">
            <input type="hidden" name="action" value="send_mail">
            
            <div style="background-color: #e8f4fd; padding: 15px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #b6d4fe;">
                <h3 style="margin-top: 0; color: #084298; font-size: 1rem;">🔐 寄件人安全設定 (發信資料用完即丟)</h3>
                <div class="form-group">
                    <label>寄件人 Gmail 帳號：</label>
                    <input type="email" name="smtp_email" required placeholder="例如：yourname@gmail.com">
                </div>
                <div class="form-group">
                    <label>應用程式密碼 (16碼)：</label>
                    <input type="password" name="smtp_pass" required placeholder="請輸入 Google 應用程式密碼">
                </div>
            </div>

            <div class="form-group">
                <label>發送模式：</label>
                <select name="mode">
                    <option value="all">全部寄送</option>
                    <option value="random">隨機寄送指定筆數</option>
                </select>
            </div>
            <div class="form-group">
                <label>隨機寄送筆數 (若選全部寄送則無效)：</label>
                <input type="number" name="random_limit" value="2" min="1">
            </div>
            <div class="form-group">
                <label>每封信寄送間隔時間 (秒)：</label>
                <input type="number" name="delay" value="2" min="0">
            </div>
            <div class="form-group">
                <label>郵件主旨：</label>
                <input type="text" name="subject" required placeholder="請輸入主旨">
            </div>
            <div class="form-group">
                <label>郵件內容：</label>
                <textarea name="content" rows="6" required placeholder="請輸入郵件內文"></textarea>
            </div>
            <button type="submit" class="btn-orange">🚀 開始發送任務</button>
        </form>
    </div>
</body>
</html>