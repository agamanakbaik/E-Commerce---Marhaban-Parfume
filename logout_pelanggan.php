<?php
session_start();
session_destroy();
setcookie("remember_me", "", time() - 3600, "/"); // Hapus cookie
header("Location: login.php");
exit;
