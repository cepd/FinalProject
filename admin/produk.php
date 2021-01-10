<h2>Produk Penjualan</h2>

<?php
session_start();
if(!isset($_SESSION['adminn']))
{
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
}

?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>harga</th>
            <th>berat</th>
            <th>foto</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
    <?php $ambil=$koneksi->query("SELECT * FROM produk");?>
    <?php while ($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td><?php echo $pecah['harga_produk']; ?></td>
            <td><?php echo $pecah['berat']; ?></td>
            <td>
                <img src="../foto_banten/<?php echo $pecah['foto_produk']; ?>" width="100">
            </td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-warning btn">ubah</a>
            </td>
        </tr>
    <?php $nomor++;?>
    <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Banten</a>