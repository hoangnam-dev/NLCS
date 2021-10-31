<?php
include("connection.php");
include("function.php");
$key = 'phone';
$id = 1;
$rs = selecttb('phone',1);
var_dump($rs);
?>