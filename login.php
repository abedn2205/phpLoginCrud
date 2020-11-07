<?php
session_start();

//set cookie

if (isset($_COOKIE['login'])) {
    if ($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('login', 'true', time() + 120);
            }

            header("location: index.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

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
                        <h1 class="h2">LOGIN</h1>
                        <p class="lead">Silahkan masukkan username dan password anda!</p>
                        <?php if (isset($error)) : ?>
                            <p style="color: red; font-style:italic;">username / password salah</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 mx-auto mt-1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        <a href="registrasi.php">Belum Punya Akun? Daftar</a>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <br><br><br>
    <footer>
        <p>Belajar Dasar Pemrograman PHP &#169; 2020, Tangerang</p>
    </footer>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>

</html>