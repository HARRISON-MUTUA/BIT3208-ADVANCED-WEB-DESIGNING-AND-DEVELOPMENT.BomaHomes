<?php

$conn = mysqli_connect("localhost", "root", "", "bomahomes");

if($conn){
    echo "Connected Successfully";
}else{
    echo "Connection Failed";
}

?>