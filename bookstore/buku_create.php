<?php 
ob_start();
include("template/header.php"); 

// 1. Proteksi: Hanya Admin yang bisa tambah buku
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: listbuku.php");
    exit();
}

// 2. Pindahkan logika pemrosesan form ke atas sebelum HTML dirender
if (isset($_POST['submit'])) {
    // Ambil data dan bersihkan dari whitespace
    $id_kategori_buku = trim($_POST['id_kategori_buku']);
    $judul_buku       = trim($_POST['judul_buku']);
    $pengarang        = trim($_POST['pengarang']);
    $penerbit         = trim($_POST['penerbit']);
    $tahun_terbit     = trim($_POST['tahun_terbit']);
    $harga            = trim($_POST['harga']);

    // Logika upload gambar yang aman
    $nama_gambar = $_FILES['gambar']['name'];
    $tmp_gambar  = $_FILES['gambar']['tmp_name'];
    $error_gambar= $_FILES['gambar']['error'];

    if ($error_gambar === 0) {
        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensi_file  = explode('.', $nama_gambar);
        $ekstensi_file  = strtolower(end($ekstensi_file));

        // Validasi ekstensi file
        if (in_array($ekstensi_file, $ekstensi_valid)) {
            // Generate nama file baru yang unik agar tidak bentrok
            $nama_gambar_baru = uniqid() . '.' . $ekstensi_file;
            $folder_tujuan    = "img/" . $nama_gambar_baru;

            if (move_uploaded_file($tmp_gambar, $folder_tujuan)) {
                
                // 3. Gunakan Prepared Statements untuk keamanan dari SQL Injection
                $query = "INSERT INTO `buku` (`id_kategori_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `harga`, `gambar`) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = mysqli_prepare($connection, $query);
                
                if ($stmt) {
                    // "issssss" berarti: integer, string, string, string, string, string, string
                    mysqli_stmt_bind_param($stmt, "issssss", $id_kategori_buku, $judul_buku, $pengarang, $penerbit, $tahun_terbit, $harga, $nama_gambar_baru);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    header("Location: listbuku.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal menyiapkan query database.');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload gambar.');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak didukung! Pilih JPG, JPEG, PNG, atau WEBP.');</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan pada file yang diupload.');</script>";
    }
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0 text-center fw-bold">Tambah Buku Baru</h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label fw-semibold">Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" id="judul_buku" placeholder="Masukkan judul buku" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_kategori_buku" class="form-label fw-semibold">Kategori Buku</label>
                            <select name="id_kategori_buku" class="form-select" id="id_kategori_buku" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php
                                $kat_query = mysqli_query($connection, "SELECT * FROM kategori_buku");
                                while($kat = mysqli_fetch_assoc($kat_query)) {
                                    echo "<option value='".$kat['id']."'>".htmlspecialchars($kat['nama'])."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pengarang" class="form-label fw-semibold">Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" id="pengarang" placeholder="Nama penulis/pengarang" required>
                        </div>

                        <div class="mb-3">
                            <label for="penerbit" class="form-label fw-semibold">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Nama perusahaan penerbit" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" maxlength="4" placeholder="Contoh: 2024" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="Contoh: 85000" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-semibold">Cover Buku</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" required>
                            <div class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG, WEBP.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                            <a href="listbuku.php" class="btn btn-light px-4 me-md-2">Kembali</a>
                            <button type="submit" name="submit" class="btn btn-primary px-4">Simpan Buku</button>
                        </div>
                        
                    </form>
                </div>
            </div> </div>
    </div>
</div>

<?php 
    require 'template/footer.php';
?>