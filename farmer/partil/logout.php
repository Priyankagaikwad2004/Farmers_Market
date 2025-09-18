<?php
session_start();
session_unset();
session_destroy();
header("Location: /farmer/index.php");
// header("Location: farmer/index.php");
exit();
?>
