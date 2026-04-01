<?php
require '../Model/pdo.php';

if(isset($_POST['libelle']) && !empty($_POST['libelle'])) {
    $libelle = $_POST['libelle'];

    $stmt = $dbPDO->prepare("INSERT INTO matieres(nom) VALUES(:libelle)");
    $stmt->execute(['libelle' => $libelle]);

    echo "Matière ajoutée : $libelle <br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
} else {
    echo "Veuillez saisir un libellé.";
}
?>