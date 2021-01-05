<?php
session_start();
$koneksi = new mysqli("localhost", "root","","bantenku");

//jika tidak ada session pelanggan

if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo"<script>alert('silahkan login');</script>";
    echo"<script>location='login.php';</script>";
}

//mendapatkan id_pembelian
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];


if($id_pelanggan_login !==$id_pelanggan_beli)
{
    echo"<script>alert('Error 404.');</script>";
   echo"<script>location='riwayat.php';</script>";
      exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php';?>

<div class="container">
    <h2>Konfirmasi Pembayaran</h2>
    <div class="alert alert-info">Total Tagihan Anda <strong> Rp<?php echo number_format($detpem["total_pembelian"]);?></strong>
    </div>


    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" class="form-control" name="nama">
        </div>

        <div class="form-group">
            <label>Bank</label>
            <input type="text" class="form-control" name="bank">
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="1">
        </div>

        <div class="form-group">
            <label>Foto Bukti</label>
            <input type="file" class="form-control" name="bukti">
            <p class="text-danger">*foto bukti harus jpg./png. maksimal 2MB</p>
        </div>
        <button class="btn btn-primary" name="kirim">Kirim</button>
    </form>
</div>

<?php

if(isset($_POST["kirim"]))
{
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    $koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti)
                        VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");



    //update status
    $koneksi->query("UPDATE pembelian SET status_pembelian='proceed'
                    WHERE id_pembelian = '$idpem'");

    echo"<script>alert('terima kasih sudah mengirimkan bukti pembayaran');</script>";
    echo"<script>location='riwayat.php';</script>";

}

?>

    
</body>
</html>