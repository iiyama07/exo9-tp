<?php
require '../Model/pdo.php';

if(isset($_POST['nom'], $_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Classe en dur : id = 1
    $stmt = $dbPDO->prepare("INSERT INTO eleves(nom, prenom, classe_id) VALUES(:nom, :prenom, 1)");
    $stmt->execute(['nom' => $nom, 'prenom' => $prenom]);

    echo "Élève ajouté : $nom $prenom <br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
} else {
    echo "Veuillez saisir le nom et le prénom.";
}
?>