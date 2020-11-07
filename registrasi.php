<?php

require 'functions.php';
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap -->
    <link href="bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body>
    <main>
        <form action="" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 text-center mt-5 mx-auto p-2">
                        <h1 class="h2">DAFTAR</h1>
                        <p class="lead">Silahkan daftarkan username dan password anda!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 mx-auto mt-1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" id="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" name="password2" id="password2" placeholder="Konfirmasi password">
                        </div>
                        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                        <a href="login.php">Sudah Punya Akun? Masuk</a>
                    </div>

                </div>

            </div>
        </form>
    </main>
    <br>
    <footer>
        <p>Belajar Dasar Pemrograman PHP &#169; 2020, Tangerang</p>
    </footer>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>

</html>