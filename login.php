<?php
session_start();
$koneksi = new mysqli("localhost", "root","","bantenku");
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php';?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    <h3 class="panel-title">Login Pelanggan</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>   
                            <input type="password" class="form-control" name="password">
                        </div> 
                        <button class="btn btn-primary" name="login">Login</button>                
                    </form>
            </div>
        </div>
    </div>
</div>

<?php
//jika tombol login ditekan
if (isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    //lakukan query untuk mengecek akun di tabel pelanggan di db
    $ambil = $koneksi->query("SELECT *FROM pelanggan
    WHERE email_pelanggan = '$email'");

    $akun = $ambil->fetch_assoc();

    //jika 1 akun yang cocok, maka di loginkan
    if(password_verify($password, $akun['password_pelanggan']))
    {
        //simpan di session pelanggan
        $_SESSION["pelanggan"] = $akun;
        echo"<script>alert('Anda SUKSES login, Selamat datang di Bantenku!');</script>";

        //jika sudah belanja
        if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
        {
            echo"<script>location='checkout.php';</script>";
        }
        else
        {
            echo"<script>location='riwayat.php';</script>";
        }
        
    }
    else
    {
        //anda gagal login
        echo"<script>alert('Anda GAGAL login, periksa akun anda');</script>";
        echo"<script>location='login.php';</script>";
    }
}

?>
    
</body>
</html>