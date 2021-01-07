<?php
session_start();
$koneksi= new mysqli("localhost","root","","bantenku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php';?>
    
<section class="konten">
    <div class="container">

    <h2>Detail Pembelian</h2>
        <?php
        $ambil = $koneksi->query("SELECT*FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
        WHERE pembelian.id_pembelian='$_GET[id]'");
        $detail=$ambil->fetch_assoc();
        ?>
        

        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            <?php echo $detail['telepon_pelanggan']; ?> <br>
            <?php echo $detail ['email_pelanggan']; ?> 
        </p>


        <div class = "row">
            <div class="col-md-4">
            <h3>Pembelian</h3>
            <strong>No. Pembelian: <?php echo $detail['id_pembelian'];?></strong><br>
            Tanggal : <?php echo $detail['tanggal_pembelian'];?><br>
            Total : Rp<?php echo number_format($detail['total_pembelian']); ?>

                <div class="col-md">
                <h3>Pelanggan</h3>
                <strong><?php echo $detail['nama_pelanggan'];?></strong><br>
                <p>
                <?php echo $detail['telepon_pelanggan']; ?> <br>
                <?php echo $detail ['email_pelanggan']; ?> 
                </p>
                </div>
            </div>

                    <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong><?php echo $detail['nama_pelanggan'];?></strong><br>
                    Ongkos Kirim : Rp<?php echo number_format($detail['tarif']); ?><br>
                    Alamat : <?php echo $detail['alamat_pengiriman'];?>
                    </div>
        </div>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama produk</th>
                    <th>harga</th>
                    <th>jumlah</th>
                    <th>subtotal</th>
                </tr>
            </thead>
                <?php $nomor=1;?>
                <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk
                ON pembelian_produk.id_produk=produk.id_produk
                WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                <?php while($pecah=$ambil->fetch_assoc()) {?>
            <tbody>
            <tr>
                <td><?php echo $nomor;?></td>
                <td><?php echo $pecah['nama_produk'];?></td>
                <td><?php echo $pecah['harga_produk'];?></td>
                <td><?php echo $pecah['jumlah'];?></td>
                <td>
                    <?php echo $pecah['harga_produk']*$pecah['jumlah'];?>
                </td>
            </tr>
                <?php $nomor++;?>    
                <?php } ?>
            </tbody>
        </table>

    <div class="row">
        <div class="col-md-7">
            <div class="alert alert-info">
                <p>
                    Silahkan lakukan pembayaran Rp<?php echo number_format($detail['total_pembelian']);?> ke <br>
                    <strong>BANK BNI 0734295728 a.n. Chintya Prema Dewi</strong>
                </p>
            </div>
        </div>
    </div>
    <a href="pembayaran.php?id=<?php echo $_GET["id"];?>" class="btn btn-success">Pembayaran</a>

    </div>
</section>

</body>
</html>