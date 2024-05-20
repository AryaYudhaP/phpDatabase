<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tambah data
if (isset($_POST['add_mahasiswa'])) {
    $npm = $_POST['npm'];
    $namaMhs = $_POST['namaMhs'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHP'];

    $sql = "INSERT INTO t_mahasiswa (npm, namaMhs, alamat, noHp) VALUES ('$npm', '$namaMhs', '$alamat', '$noHP')";
    $conn->query($sql);
}

if (isset($_POST['add_matakuliah'])) {
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];

    $sql = "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kodeMK', '$namaMK', '$sks', '$jam')";
    $conn->query($sql);
}

if (isset($_POST['add_dosen'])) {
    $idDosen = $_POST['idDosen'];
    $namaDosen = $_POST['namaDosen'];
    $noHP = $_POST['noHP'];

    $sql = "INSERT INTO t_dosen (idDosen, namaDosen, noHP) VALUES ('$idDosen', '$namaDosen', '$noHP')";
    $conn->query($sql);
}

// Hapus data
if (isset($_GET['delete_mahasiswa'])) {
    $npm = $_GET['delete_mahasiswa'];
    $sql = "DELETE FROM t_mahasiswa WHERE npm='$npm'";
    $conn->query($sql);
}

if (isset($_GET['delete_matakuliah'])) {
    $kodeMK = $_GET['delete_matakuliah'];
    $sql = "DELETE FROM t_matakuliah WHERE kodeMK='$kodeMK'";
    $conn->query($sql);
}

if (isset($_GET['delete_dosen'])) {
    $idDosen = $_GET['delete_dosen'];
    $sql = "DELETE FROM t_dosen WHERE idDosen='$idDosen'";
    $conn->query($sql);
}

// Edit data mahasiswa
if (isset($_POST['update_mahasiswa'])) {
    $npm = $_POST['npm'];
    $namaMhs = $_POST['namaMhs'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHp'];

    $sql = "UPDATE t_mahasiswa SET namaMhs='$namaMhs', alamat='$alamat', noHp='$noHP' WHERE npm='$npm'";
    $conn->query($sql);
}

// Edit data matakuliah
if (isset($_POST['update_matakuliah'])) {
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];

    $sql = "UPDATE t_matakuliah SET namaMK='$namaMK', sks='$sks', jam='$jam' WHERE kodeMK='$kodeMK'";
    $conn->query($sql);
}

// Edit data dosen
if (isset($_POST['update_dosen'])) {
    $idDosen = $_POST['idDosen'];
    $namaDosen = $_POST['namaDosen'];
    $noHP = $_POST['noHP'];

    $sql = "UPDATE t_dosen SET namaDosen='$namaDosen', noHP='$noHP' WHERE idDosen='$idDosen'";
    $conn->query($sql);
}

// Pencarian data
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$mahasiswa_result = $conn->query("SELECT * FROM t_mahasiswa WHERE namaMhs LIKE '%$search%'");
$matakuliah_result = $conn->query("SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$search%'");
$dosen_result = $conn->query("SELECT * FROM t_dosen WHERE namaDosen LIKE '%$search%'");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Aplikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons a {
            color: #007bff;
            text-decoration: none;
        }
        .action-buttons a:hover {
            text-decoration: underline;
        }
        .action-buttons form {
            display: inline;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input {
            padding: 8px;
            width: calc(100% - 100px);
            box-sizing: border-box;
        }
        .search-container button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CRUD Aplikasi</h1>

        <div class="search-container">
            <form method="GET">
                <input type="text" name="search" placeholder="Cari..." value="<?php echo $search; ?>">
                <button type="submit">Cari</button>
            </form>
        </div>

        <!-- Form Tambah Mahasiswa -->
        <div class="form-container">
            <h2>Tambah Mahasiswa</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="npm">NPM:</label>
                    <input type="text" name="npm" id="npm" required>
                </div>
                <div class="form-group">
                    <label for="namaMhs">Nama Mahasiswa:</label>
                    <input type="text" name="namaMhs" id="namaMhs" required>
                </div>
                <div class="form-group">
                    <label for="podi">Program Studi:</label>
                    <input type="text" name="podi" id="podi" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" required>
                </div>
                <div class="form-group">
                    <label for="noHp">No. HP:</label>
                    <input type="text" name="noHP" id="noHP" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_mahasiswa">Tambah</button>
                </div>
            </form>
        </div>

        <!-- Form Tambah Matakuliah -->
        <div class="form-container">
            <h2>Tambah Matakuliah</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="kodeMK">Kode MK:</label>
                    <input type="text" name="kodeMK" id="kodeMK" required>
                </div>
                <div class="form-group">
                    <label for="namaMK">Nama Matakuliah:</label>
                    <input type
                    ="text" name="namaMK" id="namaMK" required>
                </div>
                <div class="form-group">
                    <label for="sks">SKS:</label>
                    <input type="number" name="sks" id="sks" required>
                </div>
                <div class="form-group">
                    <label for="jam">Jam:</label>
                    <input type="number" name="jam" id="jam" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_matakuliah">Tambah</button>
                </div>
            </form>
        </div>

        <!-- Form Tambah Dosen -->
        <div class="form-container">
            <h2>Tambah Dosen</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="idDosen">ID Dosen:</label>
                    <input type="text" name="idDosen" id="idDosen" required>
                </div>
                <div class="form-group">
                    <label for="namaDosen">Nama Dosen:</label>
                    <input type="text" name="namaDosen" id="namaDosen" required>
                </div>
                <div class="form-group">
                    <label for="noHP">No. HP:</label>
                    <input type="text" name="noHp" id="noHP" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_dosen">Tambah</button>
                </div>
            </form>
        </div>

        <!-- Tabel Mahasiswa -->
        <h2>Daftar Mahasiswa</h2>
        <table>
            <tr>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $mahasiswa_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['npm']; ?></td>
                    <td><?php echo $row['namaMhs']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['noHp']; ?></td>
                    <td class="action-buttons">
                        <a class="edit-button" href="edit_mahasiswa.php?npm=<?php echo $row['npm']; ?>">Edit</a>
                        <form method="GET" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="delete_mahasiswa" value="<?php echo $row['npm']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Tabel Matakuliah -->
        <h2>Daftar Matakuliah</h2>
        <table>
            <tr>
                <th>Kode MK</th>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $matakuliah_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['kodeMK']; ?></td>
                    <td><?php echo $row['namaMK']; ?></td>
                    <td><?php echo $row['sks']; ?></td>
                    <td><?php echo $row['jam']; ?></td>
                    <td class="action-buttons">
                        <a class="edit-button" href="edit_matakuliah.php?kodeMK=<?php echo $row['kodeMK']; ?>">Edit</a>
                        <form method="GET" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="delete_matakuliah" value="<?php echo $row['kodeMK']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Tabel Dosen -->
        <h2>Daftar Dosen</h2>
        <table>
            <tr>
                <th>ID Dosen</th>
                <th>Nama Dosen</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $dosen_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idDosen']; ?></td>
                    <td><?php echo $row['namaDosen']; ?></td>
                    <td><?php echo $row['noHP']; ?></td>
                    <td class="action-buttons">
                        <a class="edit-button" href="edit_dosen.php?idDosen=<?php echo $row['idDosen']; ?>">Edit</a>
                        <form method="GET" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="delete_dosen" value="<?php echo $row['idDosen']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
