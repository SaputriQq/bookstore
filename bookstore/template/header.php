<?php

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['login']) || !$_SESSION['login']){
    header("location:index.php");
}
require 'data/connection.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <title>Bookstore</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BookStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                            if($_SESSION['role'] == "User"){
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="listbuku.php">Katalog Buku</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="coba_cart.php">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="list_pesanan.php">List Pesanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tentang_kami.php">Tentang Kami</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="hubungi_kami.php">Hubungi Kami</a>
                                    </li>
                                <?php
                            }
                            elseif($_SESSION['role'] == "Admin"){
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="listbuku.php">Katalog Buku</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="kategori_buku.php">Kategori Buku</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="list_user.php">List User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="list_pesanan.php">List Pesanan</a>
                                    </li>
                                <?php
                            }
                        ?>
                    </ul>
                    <ul class="navbar-nav d-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['nama']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>