<?php
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    
    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username 
    if( $key === hash('sha256', $row['username']) ) {
      $_SESSION['login'] = true;  
    }
}

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
       if( password_verify($password, $row["password"]) ) {
        // set session
        $_SESSION["login"] = true;

        // cek remember me
        if( isset($_POST['remember']) ) {
            // buat cookie
            setcookie('id', $row['id'], time()+60);
            setcookie('key', hash('sha256', $row['username']), time()+60);
        }

            header("Location: index.php");
            exit;
        }
    }
   $error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <div class="container">
        <div class="login">
            <h1>Login</h1>
            <hr>

            <?php if( isset($error) ) : ?>
                <p style="color: red; font-style: italic;">username / password salah</p>
                <?php endif ?>
            <form action="" method="post">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" placeholder="username">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me </label>
                <button type="submit" name="login">Login</button>
                <p>
                    <a href="registrasi.php">Belum Punya Akun</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="img/logo2.jpg" alt="">
        </div>
    </div>
</body>
</html>