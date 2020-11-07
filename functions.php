<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    global $conn;
    $merk = htmlspecialchars($data["merk"]);
    $model = htmlspecialchars($data["model"]);
    $harga = htmlspecialchars($data["harga"]);
    $buatan = htmlspecialchars($data["buatan"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO sepatu VALUES (
        '','$merk', '$model','$harga','$buatan','$gambar'
    )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //mengecek apakah ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu')
        </script>";

        return false;
    }

    //cek apakah yang di upload gambar

    $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ektensiGambar = explode('.', $namaFile);
    $ektensiGambar = strtolower(end($ektensiGambar));
    if (!in_array($ektensiGambar, $ektensiGambarValid)) {
        echo "<script>
        alert('yang anda upload bukan gambar!')
        </script>";

        return false;
    }

    // cek ukuran gambar

    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar!')
        </script>";

        return false;
    }

    //generte nama gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ektensiGambar;

    //lolos pengecekan, gambar siap upload
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM sepatu WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $merk = htmlspecialchars($data["merk"]);
    $model = htmlspecialchars($data["model"]);
    $harga = htmlspecialchars($data["harga"]);
    $buatan = htmlspecialchars($data["buatan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    //query insert data
    $query = "UPDATE sepatu SET
                merk = '$merk',
                model = '$model',
                harga = '$harga',
                buatan = '$buatan',
                gambar = '$gambar'
            WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM sepatu WHERE
        merk LIKE '%$keyword%' OR
        model LIKE '%$keyword%'
        
        ";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar!')
        </script>";
        return false;
    }
    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai ')
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");

    return mysqli_affected_rows($conn);
}
