<?php
require 'conn.php';

if (!isset($_SESSION['idPracovnik'])) {
    header("Location: index.php");
    exit;
}

$idPracovnik = $_SESSION['idPracovnik'];

$query = "SELECT UzivatelskeJmeno FROM pracovnik WHERE idPracovnik = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idPracovnik);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$conn->close();
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
        min-height: 100vh;
        background: url(mainpage.jpg);
        background-size: cover;
        background-position: center;
    }
    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 20px 100px;
        background: transparent;
        border: 2px solid rgb(255, 255, 255);
        box-shadow: 0 0 10px rgb(255, 255, 255);
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
    }

    .logo {
        font-size: 45px;
        color: white;
        text-decoration: none;
        font-weight: 700;
    }

    .navbar a {
        position: relative;
        font-size: 18px;
        color: white;
        font-weight: 500;
        text-decoration: none;
        margin-left: 40px;
    }

    .navbar a::before {
        content: '';
        position: absolute;
        top: 100%;
        left: 0;
        width: 0;
        height: 2px;
        background: white;
        transition: .3s;
    }

    .navbar a:hover::before {
        width: 100%;
    }   

    .profile-item {
        color: white;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-top: 500px;
    }
    </style>
  </head>
  <body>
    <header class="header">
        <a href="#" class="logo">Logo</a>

        <nav class="navbar">
            <a href="dashboard.php">Dashboard</a>
            <a href="sklad.php">Provedené inventury</a>
            <a href="profil.php">Profil</a>
            <a href="logout.php">Odhlásit se</a>
        </nav>
    </header>
    <div class="profile-item"><strong>Uživatelské jméno:</strong> <?php echo htmlspecialchars($user['UzivatelskeJmeno']); ?></div>
  </body>
</html>
