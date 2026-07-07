<?php
// Ambil parameter action dari URL dan pastikan session login sudah aman
$action  = isset($_GET['action']) ? $_GET['action'] : '';
$id_user = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;

// Pastikan user sudah login sebelum melakukan update
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $id_user === 0) {
    header("location:index.php");
    exit();
}

if ($action == 'update') {
    // Pastikan data dikirim melalui method POST
    if (isset($_POST['id_buku']) && isset($_POST['jumlah'])) {
        $id_buku_arr = $_POST['id_buku'];
        $jumlah_arr  = $_POST['jumlah'];

        // Gunakan Prepared Statement di luar loop agar performa jauh lebih cepat dan aman dari SQL Injection
        $query_update = "UPDATE cart SET jumlah = ? WHERE id_user = ? AND id_buku = ?";
        
        if ($stmt = mysqli_prepare($connection, $query_update)) {
            
            // Looping untuk mengupdate setiap buku di keranjang
            for ($i = 0; $i < count($id_buku_arr); $i++) {
                $id_buku = (int)$id_buku_arr[$i];
                $jumlah  = (int)$jumlah_arr[$i];

                // Validasi sisi server: Jika user iseng memasukkan angka 0, minus, atau kosong, paksa ke minimal 1
                if ($jumlah < 1) {
                    $jumlah = 1;
                }

                // Ikat parameter ke query (jumlah: i, id_user: i, id_buku: i)
                mysqli_stmt_bind_param($stmt, "iii", $jumlah, $id_user, $id_buku);
                
                // Eksekusi update
                mysqli_stmt_execute($stmt);
            }
            
            // Tutup statement setelah selesai looping
            mysqli_stmt_close($stmt);
        }
    }
    
    // Kembalikan user ke halaman keranjang setelah update selesai
    header("location:cart.php");
    exit();
}
?>