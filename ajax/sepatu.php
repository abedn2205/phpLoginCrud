<?php
require '../functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM sepatu WHERE
merk LIKE '%$keyword%' OR
model LIKE '%$keyword%'
";
$sepatu = query($query);

?>




<table border="1" cellpading="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
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
            <td>
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