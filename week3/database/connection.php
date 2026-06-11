<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "bomahomes"
);

if(!$conn){
    die("Connection Failed");
}

echo "Database Connected Successfully";

?>