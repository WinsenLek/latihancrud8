<!DOCTYPE html>
<html>

<head>
    <title>Halaman data mahasiswa</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        tr {
            background: #f4f4f4;
        }
        td {
            text-align: center;
            
        }

        .topnav {
            background-color: #3081D0;
            overflow: hidden;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #444;
        }

        .content {
            margin: 20px;
            
        }
    </style>
</head>

<body>
    <div class="topnav">
       
        <a href="mahasiswa.php">Mahasiswa</a>
        <?php
        session_start();

        // Check if the user clicked the "Logout" link
        if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            // Destroy the session
            session_destroy();

            // Redirect to the login page or any other desired location
            header("Location: login.php");
            exit();
        }
        ?>
        <a href="login.php?logout=1">Logout</a>
    </div>

    <div class="content">
        <h2>Data Mahasiswa</h2>
        <?php

    if (isset($_SESSION['user_id'])) {
    // User is logged in, display user information
        $userId = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
    if ($role === "admin") {
        echo '<a href="forminput.php" style="padding: 0.4% 0.8%; background-color: #3081D0; color:#fff; border-radius:2px;text-decoration: none;">Tambah Data</a><br><br>';
        }
    }

        ?>
        
        <table border="1" cellspacing="0" width="100%">
            <tr style="text-align: center; background-color: #3081D0; color:white;">
                <td>No</td>
                <td>Nim</td>
                <td>Nama</td>
                <td>No Telp</td>
                <td>Email</td>
                <td>Program Studi</td>
                <?php
               
                if (isset($_SESSION['user_id'])) {
                    // User is logged in, display user information
                    $userId = $_SESSION['user_id'];
                    $username = $_SESSION['username'];
                    $role = $_SESSION['role'];
                    if ($role === "admin") {
                        echo '<td>Opsi</td>';
                    }
                }
                ?>

            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "latihan");

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $no = 1;
            $select = mysqli_query($conn, "SELECT * FROM mahasiswa");
            if (mysqli_num_rows($select) > 0) {

                while ($hasil = mysqli_fetch_array($select)) {
            ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $hasil['nim'] ?></td>
                        <td><?php echo $hasil['nama_lengkap'] ?></td>
                        <td><?php echo $hasil['telepon'] ?></td>
                        <td><?php echo $hasil['email'] ?></td>
                        <td><?php echo $hasil['jurusan'] ?></td>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            // User is logged in, display user information
                            $userId = $_SESSION['user_id'];
                            $username = $_SESSION['username'];
                            $role = $_SESSION['role'];
                            if ($role === "admin") {
                                echo '<td>
                                <a href="form-edit.php?nim=' . $hasil['nim'] . '">Edit</a>
                                <a href="delete.php?nim=' . $hasil['nim'] . '">Hapus</a>
                            </td>';
                            }
                        }
                        ?>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7" align="center">Data Kosong</td>
                </tr>
            <?php } ?>
        </table>
        <div>
</body>

</html>