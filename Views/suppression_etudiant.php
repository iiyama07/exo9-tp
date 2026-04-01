<?php
require '../Model/pdo.php';

// Vérifie qu'un id est fourni
if(!isset($_GET['id'])) {
    echo "Aucun étudiant sélectionné.<br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
    exit;
}

$id_eleve = $_GET['id'];

// Vérifie que l'étudiant existe
$stmt = $dbPDO->prepare("SELECT Id_eleve, nom, prenom FROM Eleves WHERE Id_eleve = :id");
$stmt->execute(['id' => $id_eleve]);
$eleve = $stmt->fetch(PDO::FETCH_OBJ);

if(!$eleve) {
    echo "Étudiant introuvable.<br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
    exit;
}

// Suppression
try {
    $delete = $dbPDO->prepare("DELETE FROM Eleves WHERE Id_eleve = :id");
    $delete->execute(['id' => $id_eleve]);

    echo "Suppression de l'étudiant réussie : $eleve->nom $eleve->prenom<br>";
} catch(PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage() . "<br>";
}

echo '<a href="../index.php">Retour à l\'index</a>';
?>