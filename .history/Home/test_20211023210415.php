<?php
include("./function.php");

$customer = selectAll('customer');
echo"<pre>";
print_r($customer);
exit;
?>
