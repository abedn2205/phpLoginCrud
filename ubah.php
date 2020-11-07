<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

//ambil data di url
$id = $_GET["id"];

//query data berdasarkan id
$spt = query("SELECT * FROM sepatu WHERE id = $id")[0];


// mengecek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

    //cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil di ubah');
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal diubah');
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
    <title>Ubah Data Sepatu</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap -->
    <link href="bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <h1>Form Ubah Sepatu</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $spt["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $spt["gambar"]; ?>">
        <ul>
            <div class="form-group">
                <label for="merk" class="col-sm-1 col-form-label">Merk</label>
                <input type="text" name="merk" id="merk" required value="<?= $spt["merk"]; ?>">
            </div>
            <div class="form-group">
                <label for="model" class="col-sm-1 col-form-label">Model</label>
                <input type="text" name="model" id="model" required value="<?= $spt["model"]; ?>">
            </div>
            <div class="form-group">
                <label for="harga" class="col-sm-1 col-form-label">Harga</label>
                <input type="text" name="harga" id="harga" required value="<?= $spt["harga"]; ?>">
            </div>
            <div class="form-group">
                <label for="buatan" class="col-sm-1 col-form-label">Buatan</label>
                <input type="text" name="buatan" id="buatan" required value="<?= $spt["buatan"]; ?>">
            </div>
            <div class="form-group">
                <label for="gambar" class="col-sm-1 col-form-label">Gambar</label><br>
                <img src="img/<?= $spt['gambar']; ?>" alt="gambar" width="70"><br>
                <input type="file" name="gambar" id="gambar">
            </div>
            <br>
            <button class="btn btn-primary" type="submit" name="submit">Ubah</button> ||
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </ul>
    </form>

    <footer>
        <p>Belajar Dasar Pemrograman PHP &#169; 2020, Tangerang</p>
    </footer>

    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>

</html>