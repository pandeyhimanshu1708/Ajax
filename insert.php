<?php
include 'connect.php';

extract($_POST);
// $nameSend= $_POST['nameSend'];
// $emailSend= $_POST['emailSend'];
// $mobileSend= $_POST['mobileSend'];
// $placeSend= $_POST['placeSend'];


// $nameSend = mysqli_real_escape_string($conn, $_POST["name"]);
// $emailSend = mysqli_real_escape_string($conn, $_POST["email"]);
// $mobileSend = mysqli_real_escape_string($conn, $_POST["mobile"]);
// $placeSend = mysqli_real_escape_string($conn, $_POST["place"]);

if(isset($_POST['nameSend']) && isset($_POST['emailSend']) && isset($_POST['mobileSend']) && isset($_POST['placeSend'])){
    $sql = "insert into crud (name,email,mobile,place) values ('$nameSend','$emailSend','$mobileSend','$placeSend')";

    $result = mysqli_query($con,$sql);
    // echo $result;

}

?>