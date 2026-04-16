<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $remember = isset($_POST["remember"]) ? $_POST["remember"] : "no";


    if ($password === "1234") {
        
        
        $_SESSION["login_status"] = true; //  已登入
        $_SESSION["username"] = $username; // 使用者名稱
        $_SESSION["role"] = $role;         // 角色

        if ($remember === "yes") {
        
            setcookie("UserID", $username, time() + 3600);
        }

    
        if ($role === "student") {
            header("Location: student.php");
        } elseif ($role === "teacher") {
            header("Location: teacher.php");
        } elseif ($role === "admin") {
            header("Location: admin.php");
        }
        exit;
    } else {
    
        echo "<script>alert('密碼錯誤！請輸入 1234'); history.back();</script>";
    }
}
?>