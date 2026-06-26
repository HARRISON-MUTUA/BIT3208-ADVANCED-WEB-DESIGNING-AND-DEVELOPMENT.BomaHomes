<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'super_admin'){
    header("Location: dashboard.php");
    exit();
}

include 'database/connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE landlords SET is_active = NOT is_active WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: dashboard.php");
exit();
?>