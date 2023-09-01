<?php
require('connection.inc.php');
require('add_to_cart.inc.php');
require('functions.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$type=get_safe_value($con,$_POST['type']);

if(isset($_SESSION['USER_LOGIN'])) {
    $uid=$_SESSION['USER_ID'];  
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($con,"insert into wishlist('user_id,product_id,added_on') values('$uid','$pid','$added_on')");
    echo "mysqli_query";
}else{
    echo "not_login";
}
?>