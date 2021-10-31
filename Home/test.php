<?php
include("./function.php");

while($customer = selectAll('customer')){
echo"<pre>";
print_r($customer);
}
exit;
?>
