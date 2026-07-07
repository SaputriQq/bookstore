<?php include("template/header.php"); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white py-3">
                <h4 class="card-title mb-0 text-center fw-bold">Kategori Buku</h4>
            </div>
            <div class="card-body p-4">
                <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 1;
                            $query = "SELECT * FROM kategori_buku";
                            $data = mysqli_query($connection, $query);
                            while($data_row = mysqli_fetch_assoc($data)){
                                ?>
                                    <tr>
                                        <th scope="row"><?=$x?></th>
                                        <td><?=$data_row['nama']?></td>
                                        <td>
                                            <a href="kategori_buku_update.php?id=<?=$data_row['id']?>" class="btn btn-sm btn-warning text-white">Ubah</a>
                                            <a href="kategori_buku_delete.php?id=<?=$data_row['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                $x++;
                            }
                        ?>
                    </tbody>
                </table>
                <a href="kategori_buku_create.php" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
    </div>
</div>
<?php include("template/footer.php"); ?>