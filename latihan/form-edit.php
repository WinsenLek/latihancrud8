<?php
$conn = new mysqli("localhost", "root", "", "latihan");

// Periksa koneksi
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$data_edit = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim= '" . $_GET['nim'] . "' ");
$result = mysqli_fetch_array($data_edit);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Halaman edit data</title>

	<style>
        
        body {
			align-items: center;
			justify-content: center;
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
			
        }

        h2 {
            color: #000;
        }

        form {
            width: 50%;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #3081D0;
            color: #fff;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1f5b8b;
        }

        a {
            display: inline-block;
            padding: 0.4% 0.8%;
            background-color: #3081D0;
            color: #fff;
            border-radius: 2px;
            text-decoration: none;
            margin-bottom: 10px;
        }
    
    </style>

</head>

<body>
<h2>Edit data mahasiswa</h2>
    <a href="mahasiswa.php">Data Mahasiswa</a>
    <form action="" method="POST">
        <label for="nim">Nim:</label>
        <input type="text" id="nim" name="nim" value="<?php echo $result['nim'] ?>" required>

        <label for="nama">Nama lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $result['nama_lengkap'] ?>" required>

        <label for="telp">No telepon:</label>
        <input type="text" id="telp" name="telp" value="<?php echo $result['telepon'] ?>" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $result['email'] ?>" required>

        <label for="jurusan">Program Studi:</label>
        <select id="jurusan" name="jurusan">
            <option value="<?php echo $result['jurusan'] ?>"><?php echo $result['jurusan'] ?></option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
        </select>

        <input type="submit" name="edit" value="Simpan">
    </form>
	<?php
	if (isset($_POST['edit'])) {
		$update = mysqli_query($conn, "UPDATE mahasiswa SET nama_lengkap = '" . $_POST['nama'] . "',
		telepon = '" . $_POST['telp'] . "', email = '" . $_POST['email'] . "', jurusan = '" . $_POST['jurusan'] . "' WHERE nim = '" . $_GET['nim'] . "' ");
		if ($update) {
			echo 'Berhasil edit';
		} else {
			echo 'Gagal edit';
		}
	}
	?>
</body>

</html>