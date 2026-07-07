<?php
session_start();
    if(!isset($_SESSION['login']) || !$_SESSION['login']){
        header("location:index.php");
    }

require 'data/connection.php';

$id = $_GET['id'];
$query = "DELETE FROM `buku` WHERE id = $id";
mysqli_query($connection, $query);

header("location:listbuku.php");
exit();
?>