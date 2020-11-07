<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
require 'functions.php';
// mengecek apakah tombol submit sudah di tekan atau belu
if (isset($_POST["submit"])) {


    //cek apakah data berhasil di input atau tidak
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil ditambahkan');
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal ditambahkan');
        document.location.href = 'index.php'
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sepatu</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap -->
    <link href="bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <h1>Form Tambah Sepatu</h1>

    <form action="" method="POST" enctype="multipart/form-data">


        <div class="form-group">
            <label for="merk" class="col-sm-1 col-form-label">Merk</label>
            <input class="col-3" type="text" name="merk" id="merk" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="model" class="col-sm-1 col-form-label">Model</label>
            <input class="col-3" type="text" name="model" id="model" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="harga" class="col-sm-1 col-form-label">Harga</label>
            <input class="col-3" type="text" name="harga" id="harga" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="buatan" class="col-sm-1 col-form-label">Buatan</label>
            <input class="col-3" type="text" name="buatan" id="buatan" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="gambar" class="col-sm-1 col-form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar">
        </div>

        <div>
            <button class="btn btn-primary" type="submit" name="submit">Tambah</button>||
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>

    </form>
    <br><br><br><br><br><br>
    <footer>
        <p>Belajar Dasar Pemrograman PHP &#169; 2020, Tangerang</p>
    </footer>

    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>

</html>