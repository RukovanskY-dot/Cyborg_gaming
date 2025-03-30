<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>