<?php
session_start();
include("tools/db.php");
$db = getDatabaseCennection();

if (!isset($_GET["id"])) {
    echo "Chýbajúci hráč ID.";
    exit;
}

$id = $_GET["id"];
$error = "";
$success = "";


$stmt = $db->prepare("SELECT first_name, last_name, Email FROM hráči WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email);
if (!$stmt->fetch()) {
    echo "Hráč sa nenašiel.";
    exit;
}
$stmt->close();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];

    $stmt = $db->prepare("UPDATE hráči SET first_name = ?, last_name = ?, Email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $id);
    
    if ($stmt->execute()) {
        $success = "Úspešne upravené!";
    } else {
        $error = "Chyba pri ukladaní.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <title>Upraviť hráča</title>
  <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
  <style>
    body { padding: 30px; color: white; }
    label { display: block; margin-top: 10px; }
    input[type="text"], input[type="email"] {
      width: 100%; padding: 8px; margin-top: 5px; background: #222; color: white; border: 1px solid #444;
    }
    button {
      margin-top: 20px; padding: 10px 20px; background: #28a745; border: none; color: white; border-radius: 4px;
    }
    .message { margin-top: 15px; color: #0f0; }
    .error { margin-top: 15px; color: #f33; }
  </style>
</head>
<body>
  <h2>✏️ Upraviť hráča ID: <?= $id ?></h2>

  <?php if ($success): ?><div class="message"><?= $success ?></div><?php endif; ?>
  <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

  <form method="POST">
    <label>Meno:</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($first_name) ?>" required>

    <label>Priezvisko:</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($last_name) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

    <button type="submit">💾 Uložiť zmeny</button>
  </form>
</body>
</html>
