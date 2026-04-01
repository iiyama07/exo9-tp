<?php
require '../Model/pdo.php';

// Vérifie que le formulaire a été soumis et que les champs ne sont pas vides
if(isset($_POST['nom'], $_POST['prenom'], $_POST['id_classe']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_classe = $_POST['id_classe'];

    try {
        $stmt = $dbPDO->prepare("INSERT INTO Eleves(nom, prenom, Id_Classes) VALUES(:nom, :prenom, :id_classe)");
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'id_classe' => $id_classe]);

        echo "Élève ajouté : $nom $prenom (Classe ID : $id_classe) <br>";
    } catch(PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage() . "<br>";
    }
} else {
    echo "Veuillez saisir toutes les informations.<br>";
}

echo '<a href="../index.php">Retour à l\'index</a>';
?>