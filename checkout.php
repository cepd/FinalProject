<?
session_start();
$koneksi= new mysqli("localhost","root", "","bantenku");

//no session pelanggan, dialihkan ke login.php
if(!isset($_SESSION["pelanggan"]))
{
    echo"<script>alert('Silahkan Login');</script>";
    echo"<script>location='login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <!-- jika sudah login -->
            <?php if (isset($_SESSION["pelanggan"])): ?>
                <li><a href="logout.php">Logout</a></li>
            <!--jika belum login-->
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif ?>

            <li><a href="checkout.php">Checkout</a></li>
        </ul>
    </div>
</nav>
<pre>
    <?php print_r($_SESSION["pelanggan"]);?>
</pre>
    
</body>
</html>