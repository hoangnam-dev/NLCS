<?php
include("connection.php");
include("function.php");
$key = 'phone';
$id = 1;
$rs = selecttb($key,$id);
var_dump($rs);
?>