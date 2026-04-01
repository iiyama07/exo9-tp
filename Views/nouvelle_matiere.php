<?php
require '../Model/pdo.php';

if(isset($_POST['nom'], $_POST['id_prof']) && !empty($_POST['nom'])) {
    $nom = $_POST['nom'];
    $id_prof = $_POST['id_prof'];

    try {
        $stmt = $dbPDO->prepare("INSERT INTO `Matières`(nom, `Id_Prof`) VALUES(:nom, :id_prof)");
        $stmt->execute(['nom' => $nom, 'id_prof' => $id_prof]);

        echo "Matière ajoutée : $nom (Prof ID : $id_prof)<br>";
    } catch(PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage() . "<br>";
    }
} else {
    echo "Veuillez saisir toutes les informations.<br>";
}

echo '<a href="../index.php">Retour à l\'index</a>';
?>