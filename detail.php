<?php session_start();?>

<?php
$koneksi= new mysqli("localhost","root","","bantenku");
?>

<?php

//getting product id
$id_produk = $_GET["id"];

//getting data
$ambil = $koneksi->query("SELECT * FROM  produk WHERE id_produk = '$id_produk'");
$detail = $ambil->fetch_assoc();

echo"<pre>";
print_r($detail);
echo"</pre>"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php';?>

<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_banten/<?php echo $detail["foto_produk"];?>" alt="" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2><?php echo $detail["nama_produk"] ?></h2>
                <h4>Rp<?php echo number_format($detail["harga_produk"]); ?></h4>

                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="jumlah">
                            <div class="input-group-btn">
                                <button class = "btn btn-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                //when tombol beli is clicked
                if(isset($_POST["beli"]))
                {
                    //getting the jumlah that has been input
                    $jumlah  = $_POST["jumlah"];
                    $_SESSION["keranjang"][$id_produk]=$jumlah;

                    echo "<script>alert('produk telah masuk ke keranjang belanja anda');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }

                ?>

                <p><?php echo $detail["deskripsi_produk"];?></p>
            </div>
        </div>
    </div>
</section>

</body>
</html>