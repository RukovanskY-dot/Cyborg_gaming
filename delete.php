<?php
session_start();
include("tools/db.php");
$db = getDatabaseCennection();


if (!isset($_GET["id"])) {
    echo "Chýba ID hráča.";
    exit;
}

$id = intval($_GET["id"]); 


$stmt = $db->prepare("DELETE FROM hráči WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    
    header("Location: hraci.php");
    exit;
} else {
    echo "Chyba pri vymazávaní hráča.";
}
?>
