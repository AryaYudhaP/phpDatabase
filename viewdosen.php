<?php
    include 'koneksi.php'; // memanggil file koneksi.php untuk melakukan koneksi database
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                width: 840px;
                margin: auto;
            }
            h1{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Tabel Dosen</h1>
        <center><a href="input.php">Input Data</a></center>
        <br/>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama Dosen</th>
                <th>No HP</th>
                <th>Pilihan</th>
            </tr>
            <?php
            // jalankan query untukmenampilkan semua data diurutukan ascending berdasarkan idDosen
            $query = "SELECT * FROM t_dosen ORDER BY IdDosen ASC";
            $result = mysqli_query($link, $query);

            //mengecek apakah ada eror ketika menjalankan query
            if(!$result) {
                die ("Query Error: ".mysql_errno($link) . 
                    " - ".mysqli_error($link));
            }

            // hasil query akan disimpan dalam variabel $data dalam bentuk array
            // kemudian dicetak dengan perulangan while
            while ($data = mysqli_fetch_assoc($result))
            {
                // mencetak / menampilkan data
                echo "<tr>";
                echo "<td>$data[idDosen]</td>"; //menampilkan data idDosen
                echo "<td>$data[namaDosen]</td>"; // menampilkan data namaDosen
                echo "<td>$data[noHP]</td>"; //menampilkan data noHP
                // menbuat link untuk mengedit dan menghapus data
                echo '<td>
                    <a href="editdosen.php?idDosen='.$data['idDosen'].'">Edit</a> /
                    <a href="hapusdosen.php?idDosen='.$data['idDosen'].'"
                        onclick="return confirm(\'Anda yakin akan menghapus data?\')">Hapus</a>
                </td>';
                echo "</tr>";
            }
            ?>
    </body>
</html>