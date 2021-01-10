<h2>Data Pelanggan</h2>
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
            <th>email</th>
            <th>telepon</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1;?>
        <?php $ambil=$koneksi->query("SELECT*FROM pelanggan");?>
        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <td><?php echo $pecah['email_pelanggan']; ?></td>
            <td><?php echo $pecah['telepon_pelanggan']; ?></td>
            <td>
                <a href="" class="btn btn-danger">hapus</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>