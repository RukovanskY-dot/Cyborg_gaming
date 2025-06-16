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
        session_start();
        include("partials/header.php");
    include("tools/db.php");
    $dbConnection = getDatabaseCennection();

    $login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $dbConnection->prepare("SELECT id, password FROM hráči WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["email"] = $email;
            header("Location: /Cyborg_gaming-main/profile.php");
            exit;
        } else {
            $login_error = "Nesprávne heslo.";
        }
    } else {
        $login_error = "Email neexistuje.";
    }
}

?>

<div class="login-container">
    <h2>Prihlasovanie</h2>
    <form method="POST" action="">
  <label for="email">Email:</label>
  <input type="email" name="email" required>
  <br><br>

  <label for="password">Heslo:</label>
  <input type="password" name="password" required>
  <br><br>
<?php if (!empty($login_error)): ?>
  <div style="color: red; margin-top: 10px; text-align: center;">
    <?php echo $login_error; ?>
  </div>
<?php endif; ?>

  <button type="submit">Prihlásiť</button>
</form>



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