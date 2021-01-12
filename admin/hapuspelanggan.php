<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('pelanggan terhapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";

?>