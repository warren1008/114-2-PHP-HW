<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>報名結果</title>
</head>
<body>
    <h2>✅ 報名結果確認</h2>
    <hr>
    <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            

            $name = htmlspecialchars($_POST["student_name"] ?? '未填寫');
            $phone = htmlspecialchars($_POST["phone"] ?? '未填寫');
            
            
            $diet = htmlspecialchars($_POST["diet"] ?? '未填寫');
            $session = htmlspecialchars($_POST["session"] ?? '未填寫');

            // 輸出結果
            echo "<h3>您輸入的報名資訊如下：</h3>";
            echo "<ul>";
            echo "<li><strong>學員姓名：</strong> " . $name . "</li>";
            echo "<li><strong>聯絡電話：</strong> " . $phone . "</li>";
            echo "<li><strong>飲食習慣：</strong> " . $diet . "</li>";
            echo "<li><strong>報名梯次：</strong> " . $session . "</li>";
            echo "</ul>";
            
            echo "<br><a href='login.php'>返回登入頁面</a>";
        } else {
            echo "<p style='color: red;'>請依正常程序登入並填寫報名表。</p>";
            echo "<a href='login.php'>回登入頁面</a>";
        }
    ?>
</body>
</html>