<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Přihlášení </title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url(sklad2.jpg);
      background-size: cover;
      background-position: center;
    }
    .Obálka {
      width: 420px;
      background: transparent;
      border: 2px solid rgba(255, 255, 255, .2);
      box-shadow: 0 0 10px rgba(0, 0, 0, .2);
      color: black;
      border-radius: 10px;
      padding: 30px 40px;
    }
    .Obálka h1{
      font-size: 36px;
      text-align: center;
    }
    .Obálka .input-box{
      position: relative;
      width: 100%;
      height: 50px;
      background: transparent;
      margin: 30px 0;
    }
    .input-box input{
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      outline: none;
      border: 2px solid rgba(255, 255, 255, 2);
      border-radius: 40px;
      font-size: 16px;
      color: white;
      padding: 20px 45px 20px 20px;
    }
    .input-box input::placeholder{
      color: white;
    }
    .input-box i{
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 20px;
    }
    .Obálka .remember-forgot{
      display: flex;
      justify-content: space-between;
      font-size: 14.5px;
      margin: -15px 0 15px;
    }
    .remember-forgot label input{
      margin-right: 3px;
    }
    .remember-forgot a{
      color: white;
      text-decoration: none;
    }
    .remember-forgor a:hover{
      text-decoration: underline;
    }
    .Obálka .btn {
      width: 100%;
      height: 45px;
      background: dimgray;
      border: none;
      outline: none;
      border-radius: 40px;
      box-shadow: 0 0 10px rgba(0, 0, 0, .1);
      cursor: pointer;
      font-size: 16px;
      color: white;
      font-weight: 600;
    }
    .Obálka h1 {
      color: white;
    }
    .remember-forgot label {
      color: white;
    }
  </style>
</head>

<body>

<div class="Obálka">
  <form action="login.php" method="POST">
    <h1>Přihlášení do systému</h1>
    <div class="input-box">
      <input type="text" placeholder="Přihlašovací jméno" name="username" id="username" required>
      <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
      <input type="password" placeholder="Heslo" name="password" id="password" required>
      <i class='bx bxs-lock-alt' ></i> 
    </div>
    <button type="submit" class="btn">Přihlásit se</button>
  </form>
</div>

</body>
</html>