<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Information</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .sidebar {
      height: 100%;
      width: 200px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #111;
      padding-top: 20px;
    }

    .sidebar a {
      padding: 16px;
      text-decoration: none;
      font-size: 20px;
      color: white;
      display: block;
    }

    .sidebar a:hover {
      background-color: #444;
    }

    .content {
      margin-left: 220px;
      padding: 16px;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <a href="index.php">Dashboard</a>
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
    <!-- Your main content goes here -->
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
      // User is logged in, display user information
      $userId = $_SESSION['user_id'];
      $username = $_SESSION['username'];
      $role = $_SESSION['role'];
      echo '<h2>Dashboard</h2>';
    } else {
      header("Location: login.php");
      exit();
    }
    ?>
  </div>

</body>

</html>