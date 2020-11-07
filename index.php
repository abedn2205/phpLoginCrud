<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$sepatu = query("SELECT*FROM sepatu");

//tombol cari ditekan
if (isset($_POST["cari"])) {
    $sepatu = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sepatu</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap -->
    <link href="bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="logout">
        <a href="logout.php" class="badge badge-success">LogOut</a>
    </div>


    <h1>Daftar Sepatu</h1>
    <div class="tambah">
        <a href="tambah.php" class="badge badge-success">Insert Product</a>
    </div>

    <br></br>

    <form action="" method="POST" class="form-cari">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form>
    <br>

    <div id="container" class="text-center">
        <table border="1" cellpading="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th class="aksi">Aksi</th>
                <th>Gambar</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Harga</th>
                <th>Buatan</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($sepatu as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td class="aksi">
                        <a href="ubah.php?id=<?= $row["id"]; ?>" class="badge badge-info">Ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"]; ?>" class="badge badge-info" onclick="return confirm('Apakah anda ingin menghapus!')">Hapus</>
                    </td>
                    <td><img src="img/<?= $row["gambar"]; ?>" width="75" alt="gambar.jpg"></td>
                    <td><?= $row["merk"]; ?></td>
                    <td><?= $row["model"]; ?></td>
                    <td>Rp. <?= $row["harga"]; ?></td>
                    <td><?= $row["buatan"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>

        </table>
    </div>
    <br><br>
    <footer>
        <p>Belajar Dasar Pemrograman PHP &#169; 2020, Tangerang</p>
    </footer>

    <script src="js/script.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>

</html>