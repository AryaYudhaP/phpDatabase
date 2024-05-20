<?php
    //variabel koneksi dengan database mysql
    $host = "localhost";
    $user = "root";
    $paswd = "";
    $name = "phpdatabase";

    //proses koneksi
    $link = mysqli_connect($host,$user,$paswd,$name);

    //periksa konkesi, jika gagal akan menampilkan pesan eror
    if(!$link) {
        die ("koneksi dengan database gagal: ".mysql_connect_errno() . " - ".mysql_connect_error());
    }

?>