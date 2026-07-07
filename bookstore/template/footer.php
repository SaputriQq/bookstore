<footer class="bg-dark text-white pt-4 pb-2 mt-auto w-100">
        <div class="container text-md-left">
            <div class="row text-md-left">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mt-2">
                    <h5 class="fw-bold text-uppercase mb-3 text-white">Sukses Bookstore</h5>
                    <p class="text-white-50 small">
                        Membuka jendela dunia melalui lembaran halaman. Kami berkomitmen menghadirkan buku-buku original dan berkualitas demi mendukung literasi Indonesia.
                    </p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                    <h5 class="fw-bold text-uppercase mb-3 text-white small tracking-wider">Navigasi</h5>
                    <p class="mb-1"><a href="index.php" class="text-white-50 text-decoration-none small hover-link">Beranda</a></p>
                    <p class="mb-1"><a href="produk.php" class="text-white-50 text-decoration-none small hover-link">Koleksi Buku</a></p>
                    <p class="mb-1"><a href="tentang.php" class="text-white-50 text-decoration-none small hover-link">Tentang Kami</a></p>
                    <p class="mb-1"><a href="kontak.php" class="text-white-50 text-decoration-none small hover-link">Hubungi Kami</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-2 text-white-50 small">
                    <h5 class="fw-bold text-uppercase mb-3 text-white small tracking-wider">Kontak</h5>
                    <p class="mb-1"><i class="bi bi-geo-alt-fill me-2 text-white"></i> Jl. Literasi No. 45, Jakarta</p>
                    <p class="mb-1"><i class="bi bi-envelope-fill me-2 text-white"></i> info@suksesbookstore.com</p>
                    <p class="mb-1"><i class="bi bi-telephone-fill me-2 text-white"></i> +62 812-3456-7890</p>
                    <p class="mb-0"><i class="bi bi-clock-fill me-2 text-white"></i> Setiap Hari: 09.00 - 21.00 WIB</p>
                </div>

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-2">
                    <h5 class="fw-bold text-uppercase mb-3 text-white small tracking-wider">Ikuti Kami</h5>
                    <div class="d-flex gap-3 mb-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-instagram"></i></a>
                        <!-- <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-twitter-x"></i></a> -->
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <hr class="mb-3 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white-50 small mb-0">
                        &copy; <?php echo date("Y"); ?> <strong>Sukses Bookstore</strong>. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-5 col-lg-4 text-md-end mt-2 mt-md-0">
                    <p class="text-white-50 small mb-0">
                        Made with <i class="bi bi-heart-fill text-danger"></i> for Book Lovers
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        html {
            height: 100%;
        }
        
        body {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .hover-link:hover {
            color: #0d6efd !important; 
            transition: color 0.2s ease-in-out;
        }
        footer .btn-outline-light {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
    </style>
</body>
</html>