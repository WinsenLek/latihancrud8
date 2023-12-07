<!DOCTYPE html>
<html>

<head>
	<title>Halaman input data</title>
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
<h2>Halaman input data</h2>
    <a href="mahasiswa.php">Data Mahasiswa</a>
    <form action="" method="POST">
        <label for="nim">Nim:</label>
        <input type="text" id="nim" name="nim" placeholder="Nim" autocomplete="off" required>

        <label for="nama">Nama lengkap:</label>
        <input type="text" id="nama" name="nama" placeholder="Nama lengkap" autocomplete="off" required>

        <label for="telp">No telepon:</label>
        <input type="text" id="telp" name="telp" placeholder="No telepon" autocomplete="off" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Email" autocomplete="off" required>

        <label for="jurusan">Program Studi:</label>
        <select id="jurusan" name="jurusan">
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
        </select>

        <input type="submit" name="simpan" value="Simpan">
    </form>
	<?php
	$conn = new mysqli("localhost", "root", "", "latihan");

	// Periksa koneksi
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST['simpan'])) {
		$insert = mysqli_query($conn, "INSERT INTO mahasiswa VALUES
			('" . $_POST['nim'] . "',
			'" . $_POST['nama'] . "',
			'" . $_POST['telp'] . "',
			'" . $_POST['email'] . "',
			'" . $_POST['jurusan'] . "')");
		if ($insert) {
			echo "Berhasil disimpan";
		} else {
			"Gagal disimpan" . mysqli_error($conn);
		}
	}
	?>
</body>

</html>