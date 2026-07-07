<?php
session_start();
    if(!isset($_SESSION['login']) || !$_SESSION['login']){
        header("location:index.php");
    }

require 'data/connection.php';

$id = $_GET['id'];
$query = "DELETE FROM `pesanan` WHERE id = $id";
mysqli_query($connection, $query);

header("location:list_pesanan.php");
exit();
?>