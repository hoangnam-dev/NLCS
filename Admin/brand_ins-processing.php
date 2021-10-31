<?php
include("connection.php");
include("function.php");
$key = 'phone';
$id = 2;
$rs = selecttb($key,$id);
// var_dump($rs);
echo'<pre>';
print_r($rs);
?>