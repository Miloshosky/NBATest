<?php
require_once('../../includes/config.php');

$user->logout();
header('Location: ../view/login.php');
?>