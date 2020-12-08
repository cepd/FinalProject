<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotobanten = $pecah['foto_produk'];
if (file_exists("../foto_banten/$fotobanten"))
{
    unlink("../foto_banten/$fotobanten");
}

$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";

?>