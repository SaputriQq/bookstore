<?php 
// 1. KONEKSI & SESSION INIT
require 'data/connection.php'; // Sesuaikan path ini dengan struktur folder Anda
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. PROTEKSI HALAMAN KERANJANG
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("location:index.php");
    exit();
}

$id_user = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;

// 3. LOGIKA PROSES AJAX (DIPROSES DI SINI)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'ajax_update') {
    header('Content-Type: application/json');
    
    $id_buku = isset($_POST['id_buku']) ? (int)$_POST['id_buku'] : 0;
    $aksi    = isset($_POST['aksi']) ? $_POST['aksi'] : '';

    if ($id_buku === 0 || $id_user === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
        exit();
    }

    // Tentukan query berdasarkan tombol yang diklik
    if ($aksi === 'tambah') {
        $q = "UPDATE cart SET jumlah = jumlah + 1 WHERE id_user = ? AND id_buku = ?";
    } else if ($aksi === 'kurang') {
        $q = "UPDATE cart SET jumlah = jumlah - 1 WHERE id_user = ? AND id_buku = ? AND jumlah > 1";
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Aksi tidak dikenali.']);
        exit();
    }

    if ($stmt = mysqli_prepare($connection, $q)) {
        mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_buku);
        if (mysqli_stmt_execute($stmt)) {
            
            // Ambil data terbaru untuk menghitung subtotal & total belanja baru
            $query_hitung = "SELECT cart.jumlah, buku.harga FROM cart JOIN buku ON cart.id_buku = buku.id WHERE cart.id_user = ? AND cart.id_buku = ?";
            $stmt_hitung = mysqli_prepare($connection, $query_hitung);
            mysqli_stmt_bind_param($stmt_hitung, "ii", $id_user, $id_buku);
            mysqli_stmt_execute($stmt_hitung);
            $res = mysqli_stmt_get_result($stmt_hitung);
            $row = mysqli_fetch_assoc($res);
            
            $jumlah_baru = $row['jumlah'];
            $subtotal_baru = $row['harga'] * $jumlah_baru;

            // Hitung Grand Total seluruh keranjang
            $query_total = "SELECT SUM(cart.jumlah * buku.harga) as total FROM cart JOIN buku ON cart.id_buku = buku.id WHERE cart.id_user = $id_user";
            $res_total = mysqli_query($connection, $query_total);
            $row_total = mysqli_fetch_assoc($res_total);

            echo json_encode([
                'status' => 'success',
                'jumlah' => $jumlah_baru,
                'subtotal' => "Rp " . number_format($subtotal_baru, 0, ',', '.'),
                'total_belanja' => "Rp " . number_format($row_total['total'], 0, ',', '.')
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal update database.']);
        }
        mysqli_stmt_close($stmt);
    }
    exit(); // Stop eksekusi agar HTML bawah tidak ikut tercetak dalam response AJAX
}

// 4. LOGIKA PROSES HAPUS REGULAR
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id_buku'])) {
    $id_buku_hapus = (int)$_GET['id_buku'];
    $query_delete = "DELETE FROM cart WHERE id_user = ? AND id_buku = ?";
    if ($stmt = mysqli_prepare($connection, $query_delete)) {
        mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_buku_hapus);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 5. INCLUDE HEADER TEMPLATE
include("template/header.php"); 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-secondary text-white py-3">
                    <h5 class="card-title mb-0 text-center fw-bold text-uppercase tracking-wide">
                        <i class="bi bi-cart3 me-2"></i>Keranjang Belanja Anda
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary text-uppercase fs-7">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 15%;">Gambar</th>
                                    <th scope="col" style="width: 30%;">Judul Buku</th>
                                    <th scope="col" style="width: 15%;">Harga</th>
                                    <th scope="col" class="text-center" style="width: 15%;">Jumlah</th>
                                    <th scope="col" style="width: 15%;">Subtotal</th>
                                    <th scope="col" class="text-center" style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $x = 1;
                                    $total_belanja = 0;

                                    $query = "SELECT cart.*, buku.judul_buku, buku.harga, buku.gambar 
                                            FROM cart 
                                            JOIN buku ON cart.id_buku = buku.id 
                                            WHERE cart.id_user = $id_user";
                                            
                                    $data = mysqli_query($connection, $query);
                                    $jumlah_item = mysqli_num_rows($data);

                                    if ($jumlah_item > 0) {
                                        while($data_row = mysqli_fetch_assoc($data)){
                                            $subtotal = $data_row['harga'] * $data_row['jumlah'];
                                            $total_belanja += $subtotal;
                                            ?>
                                                <tr id="buku-<?=$data_row['id_buku']?>">
                                                    <th scope="row" class="text-center text-muted"><?=$x?></th>
                                                    <td>
                                                        <img src="img/<?=$data_row['gambar']?>" alt="Cover Buku" style="width: 70px; height: 90px; object-fit: cover;" class="rounded shadow-sm border">
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold text-dark d-block mb-1"><?=$data_row['judul_buku']?></span>
                                                        <small class="text-muted">ID Buku: #<?=$data_row['id_buku']?></small>
                                                    </td>
                                                    <td class="text-secondary fw-semibold">Rp <?=number_format($data_row['harga'], 0, ',', '.')?></td>
                                                    <td>
                                                        <div class="input-group input-group-sm justify-content-center mx-auto" style="max-width: 110px;">
                                                            <button class="btn btn-outline-secondary btn-ubah px-2" type="button" data-id="<?=$data_row['id_buku']?>" data-aksi="kurang">-</button>
                                                            <span class="form-control text-center label-jumlah bg-white fw-bold px-1" style="cursor: default;"><?=$data_row['jumlah']?></span>
                                                            <button class="btn btn-outline-secondary btn-ubah px-2" type="button" data-id="<?=$data_row['id_buku']?>" data-aksi="tambah">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="label-subtotal fw-bold text-dark">Rp <?=number_format($subtotal, 0, ',', '.')?></td>
                                                    <td class="text-center">
                                                        <a href="?action=delete&id_buku=<?=$data_row['id_buku']?>" class="btn btn-sm btn-light text-danger border btn-hover-danger" onclick="return confirm('Hapus buku ini dari keranjang?')" title="Hapus Item">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                            <tr class="table-light fs-5">
                                                <td colspan="5" class="text-end fw-bold py-3 text-secondary">Total Yang Harus Dibayar :</td>
                                                <td colspan="2" id="label-total" class="fw-extrabold text-success py-3">Rp <?=number_format($total_belanja, 0, ',', '.')?></td>
                                            </tr>
                                        <?php
                                    } else {
                                        ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-5">
                                                    <div class="py-3">
                                                        <p class="mb-2 fs-5 text-secondary fw-semibold">Keranjang Belanja Anda Kosong</p>
                                                        <p class="text-muted small">Yuk, jelajahi koleksi buku terbaik kami dan mulai berbelanja!</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                        <a href="listbuku.php" class="btn btn-outline-dark px-4 py-2 fw-medium">
                            ← Kembali Belanja
                        </a>
                        <?php if ($jumlah_item > 0) : ?>
                            <a href="checkout_aksi.php" class="btn btn-success px-5 py-2 fw-bold shadow-sm">
                                Lanjutkan ke Checkout →
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.btn-ubah').forEach(button => {
    button.addEventListener('click', function() {
        const idBuku = this.getAttribute('data-id');
        const aksi = this.getAttribute('data-aksi');
        const barisTabel = document.getElementById(`buku-${idBuku}`);
        const labelJumlah = barisTabel.querySelector('.label-jumlah');
        const labelSubtotal = barisTabel.querySelector('.label-subtotal');
        const labelTotal = document.getElementById('label-total');

        // Cegah tombol minus diklik jika jumlahnya sudah 1
        if (aksi === 'kurang' && parseInt(labelJumlah.innerText) <= 1) {
            return;
        }

        // Siapkan data yang dikirim melalui AJAX POST
        const formData = new FormData();
        formData.append('id_buku', idBuku);
        formData.append('aksi', aksi);

        // Jalankan Fetch API ke file ini sendiri
        fetch('?action=ajax_update', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update tampilan angka kuantitas, subtotal, dan total belanja secara instant!
                labelJumlah.innerText = data.jumlah;
                labelSubtotal.innerText = data.subtotal;
                labelTotal.innerText = data.total_belanja;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem, silakan coba lagi.');
        });
    });
});
</script>

<?php include("template/footer.php"); ?>