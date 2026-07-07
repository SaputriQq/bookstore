<?php include("template/header.php"); ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Hubungi Kami</h1>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Punya pertanyaan seputar ketersediaan buku, pesanan, atau ingin bekerja sama? Jangan ragu untuk menghubungi tim kami. Kami siap membantu Anda!
        </p>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm p-4 h-100">
                <h3 class="fw-semibold mb-4 text-secondary">Kirim Pesan</h3>
                <form action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label for="alamatEmail" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="alamatEmail" placeholder="nama@email.com" required>
                        </div>
                        <div class="col-12">
                            <label for="subjekPesan" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subjekPesan" placeholder="Contoh: Tanya Stok Buku / Masalah Akun" required>
                        </div>
                        <div class="col-12">
                            <label for="isiPesan" class="form-label">Pesan Anda</label>
                            <textarea class="form-control" id="isiPesan" rows="5" placeholder="Tuliskan pertanyaan atau detail pesanan Anda di sini..." required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card shadow-sm p-4">
                        <h3 class="fw-semibold mb-4 text-secondary">Informasi Toko</h3>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="contact-info-icon me-3">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Alamat Utama</h6>
                                <p class="text-muted mb-0">Jl. Pustaka Raya No. 45, Blok M, Jakarta Selatan, 12160</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="contact-info-icon me-3">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <a href="https://wa.me/6287776256204?text=Halo%20Admin" style="text-decoration: none;"><h6 class="fw-bold mb-1">WhatsApp & Telepon</h6>
                                <p class="text-muted mb-0">087776256204</p></a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="contact-info-icon me-3">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <a href="mailto:support@nadiarabookstore.com" style="text-decoration: none;">
                                <h6 class="fw-bold mb-1">Email Layanan Pelanggan</h6>
                                <p class="text-muted mb-0" >support@nadiarabookstore.com</p>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="contact-info-icon me-3">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Jam Operasional</h6>
                                <p class="text-muted mb-0">Senin - Minggu: 09.00 - 21.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm map-container">
                        <iframe 
                            src="https://maps.google.com/maps?q=Strada+Vocational+High+School,+Jl.+Rajawali+Selatan+2+No.1+4,+RT.4%2FRW.6,+Gn.+Sahari+Utara,+Kecamatan+Sawah+Besar,+Kota+Jakarta+Pusat&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("template/footer.php"); ?>