<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "latihan");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi pesan error dan hasil registrasi
$error = "";
$registerResult = "";

// Tangkap data dari form pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
    $registerUsername = $_POST['register_username'];
    $registerPassword = $_POST['register_password'];
    $confirmedPassword = $_POST['register_confirmed_password'];

    // Check if passwords match
    if ($registerPassword !== $confirmedPassword) {
        $error = "Passwords do not match.";
    } else {
        $registerRole = $_POST['register_role'];

        // Hash the password
        $hashedPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

        // Insert data ke tabel pengguna
        $sql = "INSERT INTO users (username, password, role) VALUES ('$registerUsername', '$hashedPassword', '$registerRole')";

        if ($conn->query($sql) === TRUE) {
            $registerResult = "Registration successful";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Register</title>
</head>

<body>
    <div class="container">
        <form action="register.php" method="post">
            <h2>Register</h2>
            <label for="register_username">Username:</label>
            <input type="text" id="register_username" name="register_username" placeholder="Username" required>
            <label for="register_password">Password:</label>
            <input type="password" id="register_password" name="register_password" placeholder="Password" required>
            <label for="register_confirmed_password">Confirmed Password:</label>
            <input type="password" id="register_confirmed_password" name="register_confirmed_password" placeholder="Confirm Password" required>
            <label for="register_role">Role:</label>
            <select id="register_role" name="register_role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <!-- Tambahkan opsi lain jika diperlukan -->
            </select>
            <button type="submit">Register</button>
        </form>
        <?php
        // Display error message, if any
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>
