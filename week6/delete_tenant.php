<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
    exit();
}

include 'database/connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "DELETE FROM tenants WHERE id = $id AND landlord_id = $user_id";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_tenants.php?deleted=1");
        exit();
    }
}

header("Location: view_tenants.php");
exit();
?>