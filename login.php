<?php
session_start();
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT idPracovnik, Heslo FROM pracovnik WHERE UzivatelskeJmeno = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPracovnik, $db_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && $password == $db_password) {
        $_SESSION['username'] = $username;
        $_SESSION['idPracovnik'] = $idPracovnik;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Špatné heslo nebo přihlašovací jméno.";
    }

    $stmt->close();
}
?>