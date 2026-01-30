<?php
session_start();

$_SESSION['user_id'] = NULL;
$_SESSION['acc'] = NULL;
$_SESSION['role'] = NULL;
session_unset();
session_destroy();
header("Location: ../LoginApply.html");
exit;
?>