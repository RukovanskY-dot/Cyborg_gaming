<!DOCTYPE html>
<html lang="en">
<head>
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
        

    

    $first_name= "";
    $last_name= "";
    $email= ""; 
    $password = "";



    $first_name_error= "";
    $last_name_error= "";
    $email_error= "";
    $password_error = "";
    
    $error = false;
    
    include "tools/db.php";
    $dbConnection = getDatabaseCennection(); 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $statement = $dbConnection->prepare("SELECT id FROM hráči WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        $email_error = "Email existuje";
        $error = true;
    }

    if (!$error) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $dbConnection->prepare("INSERT INTO hráči (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
        $stmt->execute();

        $_SESSION["id"] = $stmt->insert_id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;

        header("Location: /Cyborg_gaming-main/index.php");
        exit;
    }
}


    

    ?>

    <div class="registration-form">
        <h2>Registrácia</h2>
        <form action="register.php" method="post">
            <label for="firstname">Meno:</label>
            <input type="text" id="first_name" name="first_name" required value="<?php echo $first_name ?>">
            <span class ="text-danger"><?php echo $first_name_error ?></span>

            <label for="lastname">Priezvisko:</label>
            <input type="text" id="last_name" name="last_name" required value="<?php echo $last_name ?>">
            <span class ="text-danger"><?php echo $last_name_error ?></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $email ?>">
            <span class ="text-danger"><?php echo $email_error ?></span>

            <label for="password">Heslo:</label>
            <input type="password" id="password" name="password" required>
            <span class="text-danger"><?php echo $password_error ?></span>


            <button type="submit">Zaregistrovať sa</button>
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
