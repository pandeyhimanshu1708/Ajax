<?php
$con = new mysqli('localhost','root','','bootstrapCrud');

if($con){
    echo "Connection Successful";
} 
else{
    die(mysqli_error($con));
}

?>