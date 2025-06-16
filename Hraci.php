<?php
session_start();
include("tools/db.php");
$db = getDatabaseCennection();

$result = $db->query("SELECT id, first_name, last_name, Email FROM hráči ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <title>Zoznam hráčov</title>
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
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
  <td><?= $row["id"] ?></td>
  <td><?= htmlspecialchars($row["first_name"]) ?></td>
  <td><?= htmlspecialchars($row["last_name"]) ?></td>
  <td><?= htmlspecialchars($row["Email"]) ?></td>
  <td>
    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Upraviť</a>
    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Naozaj chceš vymazať tohto hráča?')">Vymazať</a>


  </td>
</tr>

    <?php endwhile; ?>
  </tbody>
</table>

<a href="register.php" class="btn">Nový hráč</a>

  </div>
</body>
</html>
