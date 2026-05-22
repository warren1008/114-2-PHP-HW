<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$host = 'localhost';
$db   = 'spam_system';
$user = 'root'; 
$pass = '';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("資料庫連線失敗：" . $e->getMessage());
}


if (isset($_POST['action']) && $_POST['action'] == 'add_email') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    echo "<div style='font-family: Arial; text-align: center; margin-top: 50px;'>";
    if ($email) {
        $stmt = $pdo->prepare("INSERT INTO emails (email) VALUES (?)");
        $stmt->execute([$email]);
        echo "<h2 style='color: green;'>Email 新增成功！</h2>";
    } else {
        echo "<h2 style='color: red;'>不合法的 Email 格式！</h2>";
    }
    echo "<a href='index.php' style='text-decoration: none; padding: 10px 20px; background: #3498db; color: white; border-radius: 5px;'>返回首頁</a>";
    echo "</div>";
    exit;
}


if (isset($_POST['action']) && $_POST['action'] == 'send_mail') {
  
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

   
    if (ob_get_level()) ob_end_clean();
    ob_implicit_flush(true);
    header('Content-Type: text/html; charset=utf-8');


    $smtp_email = $_POST['smtp_email'];
    $smtp_pass  = $_POST['smtp_pass'];
    
    // 接收原本的其他設定資料
    $mode = $_POST['mode'];
    $delay = intval($_POST['delay']);
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    
    if ($mode == 'random') {
        $limit = intval($_POST['random_limit']);
        $stmt = $pdo->prepare("SELECT email FROM emails ORDER BY RAND() LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        $stmt = $pdo->query("SELECT email FROM emails");
    }
    
    $targets = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $total = count($targets);


    echo "<div style='font-family: \"微軟正黑體\", Arial, sans-serif; max-width: 600px; margin: 40px auto; background: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
    
    if ($total === 0) {
        die("<h2 style='color: red; text-align: center;'>資料庫中沒有可寄送的名單！</h2><div style='text-align: center;'><a href='index.php'>返回首頁</a></div></div>");
    }

    echo "<h2>🚀 開始執行寄送任務...</h2>";
    echo "<p>預計寄送：<strong>$total</strong> 筆</p><hr>";
    echo str_repeat(' ', 4096); 
    flush();

  
    foreach ($targets as $index => $email) {
        $current = $index + 1;
        $percent = round(($current / $total) * 100);

        echo "<div style='margin-bottom: 12px; font-size: 15px; border-bottom: 1px dashed #eee; padding-bottom: 8px;'>";
        echo "進度 <span style='color: #2980b9; font-weight: bold;'>[ {$percent}% ]</span> ({$current}/{$total}) 正在寄給 {$email} ... ";
        flush();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            
          
            $mail->Username   = $smtp_email; 
            $mail->Password   = $smtp_pass;    
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

          
            $mail->setFrom($smtp_email, '網頁程式設計系統'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = $subject;
            
        
            $mail->Body = nl2br(htmlspecialchars($content)); 

            $mail->send();
            echo "<span style='color: #27ae60; font-weight: bold;'>✅ 成功！</span>";
        } catch (Exception $e) {
            echo "<span style='color: #e74c3c; font-weight: bold;'>❌ 失敗：{$mail->ErrorInfo}</span>";
        }
        echo "</div>";
        flush();

        
        if ($current < $total) {
            sleep($delay);
        }
    }
    
    echo "<h3 style='text-align: center; color: #2c3e50; margin-top: 20px;'>🎉 全部任務執行完畢！</h3>";
    echo "<div style='text-align: center;'><button onclick='window.close()' style='padding: 8px 15px; cursor: pointer;'>關閉此視窗</button></div>";
    echo "</div>";
    exit;
}
?>