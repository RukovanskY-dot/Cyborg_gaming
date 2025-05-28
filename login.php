<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    
</head>
<body>
    <?php
        include("partials/header.php");
    ?>

<div class="login-container">
    <h2>Registrácia</h2>
    <form method="POST" action="">
        <label for="username">Prihlasovacie meno:</label>
        <input type="text" name="username" required>
        <br><br>
        <label for="password">Heslo:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Bejelentkezés</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        echo "<p>Prihlasovacie meno: " . htmlspecialchars($username) . "</p>";
        echo "<p>Heslo: " . htmlspecialchars($password) . "</p>";
    }
    ?>
    </div>
    
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>