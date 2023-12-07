<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "latihan");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi pesan error dan hasil login
$error = "";
$loginResult = "";

// Periksa apakah formulir login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = $_POST['login_username'];
    $loginPassword = $_POST['login_password'];

    // Ambil data pengguna dari database berdasarkan username
    $result = $conn->query("SELECT * FROM users WHERE username='$loginUsername'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($loginPassword, $row['password'])) {
            // Simpan informasi pengguna dalam sesi
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            $loginResult = "Login successful";
            header("Location: mahasiswa.php");
            exit();
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "Username not found";
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Login</title>
</head>

<body >
    <div class="container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="login_username" placeholder="Username" required>
            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="login_password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        // Display error message, if any
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>

</html>
