<?php   
session_start();
session_destroy();
header("location:/brief/php");
exit();
?>