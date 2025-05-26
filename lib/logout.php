<?php
    setcookie("login", "", time() - 3600 * 24 * 30, "/SummerPractice2/");
    header("Location: /SummerPractice2/index.php");
?>