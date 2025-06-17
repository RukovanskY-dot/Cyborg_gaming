<?php
session_start();
include("tools/db.php");

require_once 'tools/Auth.php';
$auth = new Auth();

if (!$auth->isLoggedIn() || !$auth->isAdmin()) {
    header("Location: login.php");
    exit();
}





class Player {
    public $id;
    public $firstName;
    public $lastName;
    public $email;

    public function __construct($id, $firstName, $lastName, $email) {
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

     /**
     * 
     * @return Player[]
     */
    public function getAll(): array {
        $result = $this->db->query("SELECT id, first_name, last_name, email FROM hráči ORDER BY id DESC");
        $players = [];

        while ($row = $result->fetch_assoc()) {
            $players[] = new Player(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email']
            );
        }

        return $players;
    }
}


$db = getDatabaseCennection();
$repo = new PlayerRepository($db);
$players = $repo->getAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Zoznam hráčov (OOP)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 30px; font-size: 14px; }
    th, td { padding: 8px 10px; border-bottom: 1px solid #444; color: white; }
    th { background-color: #222; text-align: left; }
    tr:hover { background-color: #2a2a2a; }
    .container { padding: 30px; }
    h2 { color: white; }
    .btn { display: inline-block; padding: 8px 12px; margin-top: 10px; background-color: #28a745; color: white; border-radius: 5px; text-decoration: none; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Zaregistrovaní hráči</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Meno</th>
          <th>Priezvisko</th>
          <th>Email</th>
          <th>Akcia</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($players as $player): ?>
          <tr>
            <td><?= $player->id ?></td>
            <td><?= htmlspecialchars($player->firstName) ?></td>
            <td><?= htmlspecialchars($player->lastName) ?></td>
            <td><?= htmlspecialchars($player->email) ?></td>
            <td>
              <a href="edit.php?id=<?= $player->id ?>" class="btn btn-primary btn-sm">Upraviť</a>
              <a href="delete.php?id=<?= $player->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Naozaj chceš vymazať tohto hráča?')">Vymazať</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="register.php" class="btn">Nový hráč</a>
  </div>
</body>
</html>
