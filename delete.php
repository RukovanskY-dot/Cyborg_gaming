<?php
session_start();
include("tools/db.php");



class PlayerRepository {
    private mysqli $db;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function deleteById(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM hráči WHERE id = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}



if (!isset($_GET["id"])) {
    echo "Chýba ID hráča.";
    exit;
}

$id = (int)$_GET["id"];
$db = getDatabaseCennection();
$repo = new PlayerRepository($db);

if ($repo->deleteById($id)) {
    header("Location: hraci.php");
    exit;
} else {
    echo "Chyba pri vymazávaní hráča.";
}
?>
