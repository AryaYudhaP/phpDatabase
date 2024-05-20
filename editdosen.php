<?php
    // memanggil file koneksi.php untuk membuat koneksi
    include 'koneksi.php';

    // mengecek apakah di url ada nilai GET idDosen
    if (isset($_GET['idDosen'])) {
        // ambil nilai idDosen dari url dan disimpan dalam variabel $id
        $id = ($_GET['idDosen']);
    
        // menampilkan data t_dosen dari database yang mempunyai idDosen=$id
        $query = "SELECT * FROM t_dosen WHERE idDosen='$id'";
        $result = mysqli_query($link, $query);
        // mengecek apakah query gagal
        if(!$result) {
            die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
            }
        // mengambil data dari database dan membuat variabel-variabel utk menampung data
        // variabel ini nantinya akan ditampilkan pada form
        $data = mysqli_fetch_assoc($result);
        $idDosen = $data["idDosen"];
        $namaDosen = $data["namaDosen"];
        $noHP = $data["noHP"];
    } else {
        // apabila tidak ada data GET id pada akan di redirect ke index.php
        header("location:viewdosen.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            h1{
                text-align: center
            }
            .container{
                width: 400px;
                margin: auto;
            }
        </style>
    </head>
    <body>
        <h1>Edit Data</h1>
        <div class="container">
            <form id="form_mahasiswa" action="proses_editdosen.php" method="post">
            
                <fieldset>
                <legend>Edit Data Dosen</legend>
                    <p>
                        <label for="idDosen">ID :</label>
                        <input type="hidden" name="idDosen" value="<?php echo $idDosen; ?>">
                        <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $idDosen; ?>" disabled>
                    </p>
                    <p>
                        <label for="namaDosen">Nama Dosen :</label>
                        <input type="text" name="namaDosen" id="namaDosen" value="<?php echo $namaDosen; ?>">
                    </p>
                    <p>
                        <label for="noHP">No HP :</label>
                        <input type="text" name="noHP" id="noHP" value="<?php echo $noHP; ?>">
                    </p>
                </fieldset>
                <p>
                    <input type="submit" name="edit" value="Update Data">
                </p>
            </form>
        </div>
    </body>
</html>