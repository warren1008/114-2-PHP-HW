<?php

setcookie("UserID", "", time() - 3600);

echo "<script>alert('Cookie 已成功刪除！'); location.href='login.php';</script>";
?>