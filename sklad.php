<?php
require 'conn.php';

if (!isset($_SESSION['idPracovnik'])) {
    header("Location: login.php");
    exit();
}


$skladQuery = "SELECT idSklad, Nazev FROM sklad";
$skladResult = $conn->query($skladQuery);

$inventuraData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectSklad'])) {
    $skladId = $_POST['sklad'];

    $inventuraQuery = "SELECT i.*, p.Nazev AS PolozkaNazev 
                       FROM inventura i 
                       JOIN polozka p ON i.Polozka_idPolozka = p.idPolozka 
                       WHERE i.Sklad_idSklad = ?";
    $stmt = $conn->prepare($inventuraQuery);
    $stmt->bind_param('i', $skladId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $inventuraData[] = $row;
    }
    $stmt->close();
}
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
        .container {
            margin: 100px auto;
            width: 70%;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container select, .container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container button {
            padding: 10px 20px;
            background: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container button:hover {
            background: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
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
    <div class="container">
        <h2>Výběr skladu</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="sklad">Vyberte sklad:</label>
            <select id="sklad" name="sklad" required>
                <?php while($sklad = $skladResult->fetch_assoc()): ?>
                    <option value="<?php echo $sklad['idSklad']; ?>"><?php echo htmlspecialchars($sklad['Nazev']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="selectSklad">Zobrazit inventury</button>
        </form>
        <?php if (!empty($inventuraData)): ?>
            <h2>Inventura zvoleného skladu</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Inventury</th>
                        <th>ID Skladu</th>
                        <th>Název položky</th>
                        <th>Počet kusů</th>
                        <th>ID Pracovníka</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventuraData as $row): ?>
                        <tr>
                            <td><?php echo $row['idInventura']; ?></td>
                            <td><?php echo $row['Sklad_idSklad']; ?></td>
                            <td><?php echo htmlspecialchars($row['PolozkaNazev']); ?></td>
                            <td><?php echo $row['ks']; ?></td>
                            <td><?php echo $row['Pracovnik_idPracovnik']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
