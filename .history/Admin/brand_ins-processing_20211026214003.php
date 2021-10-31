<?php
include("connection.php");
include("function.php");

$rs = selecttb('phone',1);
var_dump($rs);
?>