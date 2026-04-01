<?php
require '../Model/pdo.php';

// Vérifie qu'on a un id
if(!isset($_GET['id'])) {
    echo "Aucun étudiant sélectionné.<br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
    exit;
}

$id_eleve = $_GET['id'];

// Récupère les infos de l'étudiant
$stmt = $dbPDO->prepare("SELECT Id_eleve, nom, prenom, Id_Classes FROM Eleves WHERE Id_eleve = :id");
$stmt->execute(['id' => $id_eleve]);
$eleve = $stmt->fetch(PDO::FETCH_OBJ);

if(!$eleve) {
    echo "Étudiant introuvable.<br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
    exit;
}

// Si formulaire soumis, on met à jour
if(isset($_POST['nom'], $_POST['prenom'], $_POST['id_classe'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_classe = $_POST['id_classe'];

    $update = $dbPDO->prepare("UPDATE Eleves SET nom=:nom, prenom=:prenom, Id_Classes=:id_classe WHERE Id_eleve=:id");
    $update->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'id_classe' => $id_classe,
        'id' => $id_eleve
    ]);

    echo "Étudiant modifié : $nom $prenom<br>";
    echo '<a href="../index.php">Retour à l\'index</a>';
    exit;
}
?>

<h2>Modifier l'étudiant</h2>

<form action="" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($eleve->nom); ?>" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($eleve->prenom); ?>" required>

    <label for="id_classe">Classe :</label>
    <select name="id_classe" id="id_classe" required>
        <?php
        $stmt = $dbPDO->prepare("SELECT Id_Classes, nom FROM Classes");
        $stmt->execute();
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($classes as $c) {
            $selected = ($c->Id_Classes == $eleve->Id_Classes) ? 'selected' : '';
            echo "<option value='$c->Id_Classes' $selected>$c->nom</option>";
        }
        ?>
    </select>

    <button type="submit">Valider</button>
</form>