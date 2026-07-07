<?php 
    // 1. Hubungkan koneksi database terlebih dahulu jika variabel $connection ada di file terpisah
    // include("config/koneksi.php"); 

    if(isset($_POST['submit'])){
        // Ambil file koneksi di sini jika $connection di-include di dalam template/header.php
        include("template/header.php"); 
        
        extract($_POST);
        $query = "INSERT INTO `kategori_buku`(`nama`) VALUES ('$nama')";
        mysqli_query($connection, $query);

        // Redirect sekarang aman karena dilakukan di paling atas sebelum HTML render
        header("location:kategori_buku.php");
        exit(); // Sangat disarankan menghentikan script setelah redirect
    }
?>

<?php include("template/header.php"); ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0 text-center fw-bold">Tambah Kategori Buku</h4>
                </div>
                <div class="card-body p-4">
                    <h1>Tambah Kategori</h1>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("template/footer.php"); ?>