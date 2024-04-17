<?php
require 'functions.php';

if( isset($_POST["register"]) ) {

    if( registrasi($_POST) > 0 ) {
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html> 
    <html>
        <head>
            <title>Registrasi</title>
            <link rel="stylesheet" href="css/style2.css">
            <style>
               label {
                display: block;
               }
            </style>
        </head>
        <body>
        <div class="container">
            <div class="login">
            
            <h1>Registrasi</h1>
            <hr>
            <form action="" method="post">
                <label for="username">username :</label>
                <input type="text" name="username" id="username">
                <label for="password">password :</label>
                <input type="password" name="password" id="password">
                <label for="password2">konfigurasi password :</label>
                <input type="password" name="password2" id="password2">
                <button type="submit" name="register">Register!</button>
                <p>
                    <a href="login.php">Sudah Punya Akun</a>
                </p>
            </form>
            </div>
        </div>
        </body>
    </html>