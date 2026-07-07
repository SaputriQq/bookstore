<?php
    include("template/header.php"); 
    // include("koneksi.php"); // Buka komen ini jika file koneksinya terpisah

    // 2. Validasi apakah ID ada di URL untuk mencegah error saat pertama kali dibuka
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("ID tidak ditemukan.");
    }

    // Gunakan mysqli_real_escape_string untuk keamanan dasar dari SQL Injection
    $id_get = mysqli_real_escape_string($connection, $_GET['id']);

    // --- LOGIKA PROSES UPDATE (Dipindahkan ke atas agar eksekusi lebih rapi) ---
    if(isset($_POST['submit'])){
        // Ambil data dan amankan
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $nama = mysqli_real_escape_string($connection, $_POST['nama']);
        
        $query_update = "UPDATE `kategori_buku` SET `nama`='$nama' WHERE id = '$id'";
        
        if(mysqli_query($connection, $query_update)){
            // Gunakan JavaScript untuk redirect jika fungsi header() error karena "headers already sent"
            echo "<script>window.location.href='kategori_buku.php';</script>";
            exit;
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($connection);
        }
    }
    // -------------------------------------------------------------------------

    // Ambil data lama untuk ditampilkan di form
    $query = "SELECT * FROM `kategori_buku` WHERE id = '$id_get'"; 
    $data = mysqli_query($connection, $query);

    // Cek apakah query berhasil dan data ditemukan
    if ($data && mysqli_num_rows($data) > 0) {
        $data_row = mysqli_fetch_assoc($data);
    } else {
        die("Data tidak ditemukan atau query error: " . mysqli_error($connection));
    }
?>

<div class="container mt-4">
    <div class="row justify-content-center">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white py-3">
                    <h4 class="card-title mb-0 text-center fw-bold">Ubah Kategori Buku</h4>
                </div>
                <div class="card-body p-4">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . urlencode($_GET['id']); ?>" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($data_row['nama']) ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>      
    </div>
</div> <?php 
    include("template/footer.php");
?>