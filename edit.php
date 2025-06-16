<?php
session_start();
include("tools/db.php");


class Player {
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;

    public function __construct(int $id, string $firstName, string $lastName, string $email) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}

class PlayerRepository {
    private mysqli $db;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function findById(int $id): ?Player {
        $stmt = $this->db->prepare("SELECT first_name, last_name, email FROM hráči WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName, $email);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Player($id, $firstName, $lastName, $email);
        }

        $stmt->close();
        return null;
    }

    public function update(Player $player): bool {
        $stmt = $this->db->prepare("UPDATE hráči SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $player->firstName, $player->lastName, $player->email, $player->id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}


$db = getDatabaseCennection();
$repo = new PlayerRepository($db);

$error = "";
$success = "";

if (!isset($_GET["id"])) {
    echo "Chýbajúci hráč ID.";
    exit;
}

$id = (int)$_GET["id"];
$player = $repo->findById($id);

if (!$player) {
    echo "Hráč sa nenašiel.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $player->firstName = $_POST["first_name"] ?? '';
    $player->lastName = $_POST["last_name"] ?? '';
    $player->email = $_POST["email"] ?? '';

    if ($repo->update($player)) {
        $success = "Úspešne upravené!";
    } else {
        $error = "Chyba pri ukladaní.";
    }
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
  <h2>✏️ Upraviť hráča ID: <?= $player->id ?></h2>

  <?php if ($success): ?><div class="message"><?= $success ?></div><?php endif; ?>
  <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

  <form method="POST">
    <label>Meno:</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($player->firstName) ?>" required>

    <label>Priezvisko:</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($player->lastName) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($player->email) ?>" required>

    <button type="submit">💾 Uložiť zmeny</button>
  </form>
</body>
</html>
