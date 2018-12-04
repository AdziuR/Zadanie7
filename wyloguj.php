<?php
setcookie("nazwisko", "", time() - 3600);
header("Location: loguj.php");
?>