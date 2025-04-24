<?php
require 'conn.php';

if (!isset($_SESSION['idPracovnik'])) {
    header("Location: login.php");
    exit();
}

$skladQuery = "SELECT idSklad, Nazev FROM sklad";
$skladResult = $conn->query($skladQuery);

$polozkaQuery = "SELECT idPolozka, Nazev, Cena FROM polozka";
$polozkaResult = $conn->query($polozkaQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addProduct'])) {
    $skladId = $_POST['sklad'];
    $polozkaId = $_POST['polozka'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $pracovnikId = $_SESSION['idPracovnik'];

    $updateQuery = "INSERT INTO inventura (Sklad_idSklad, Polozka_idPolozka, Pracovnik_idPracovnik, ks) 
                    VALUES (?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE ks = ks + VALUES(ks)";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('iiii', $skladId, $polozkaId, $pracovnikId, $quantity);
    $stmt->execute();
    $stmt->close();

    $priceUpdateQuery = "UPDATE polozka SET Cena = ? WHERE idPolozka = ?";
    $stmt = $conn->prepare($priceUpdateQuery);
    $stmt->bind_param('ii', $price, $polozkaId);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            width: 50%;
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
        <h2>Přidat produkt do skladu</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="sklad">Vyberte sklad:</label>
            <select id="sklad" name="sklad" required>
                <?php while($sklad = $skladResult->fetch_assoc()): ?>
                    <option value="<?php echo $sklad['idSklad']; ?>"><?php echo htmlspecialchars($sklad['Nazev']); ?></option>
                <?php endwhile; ?>
            </select>

            <label for="polozka">Vyberte položku:</label>
            <select id="polozka" name="polozka" required>
                <?php while($polozka = $polozkaResult->fetch_assoc()): ?>
                    <option value="<?php echo $polozka['idPolozka']; ?>" data-price="<?php echo $polozka['Cena']; ?>"><?php echo htmlspecialchars($polozka['Nazev']); ?></option>
                <?php endwhile; ?>
            </select>

            <label for="quantity">Počet kusů:</label>
            <input type="number" id="quantity" name="quantity"required>

            <label for="price">Cena:</label>
            <input type="number" id="price" name="price" required>

            <button type="submit" name="addProduct">Přidat</button>
        </form>
    </div>
    <script>
        document.getElementById('polozka').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            document.getElementById('price').value = price;
        });
    </script>
</body>
</html>
