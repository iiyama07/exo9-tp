<?php
require 'Model/pdo.php'; // connexion PDO

// Étudiants
echo "<h2>Étudiants</h2>";
$stmt = $dbPDO->prepare("SELECT nom, prenom FROM eleves");
$stmt->execute();
$eleves = $stmt->fetchAll(PDO::FETCH_CLASS);

echo "<ul>";
foreach($eleves as $eleve) {
    echo "<li>$eleve->nom $eleve->prenom</li>";
}
echo "</ul>";

// Classes
echo "<h2>Classes</h2>";
$stmt = $dbPDO->prepare("SELECT nom FROM classes");
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_CLASS);

echo "<ul>";
foreach($classes as $classe) {
    echo "<li>$classe->nom</li>";
}
echo "</ul>";

// Profs
echo "<h2>Professeurs</h2>";
$stmt = $dbPDO->prepare("SELECT nom, prenom FROM prof");
$stmt->execute();
$profs = $stmt->fetchAll(PDO::FETCH_CLASS);

echo "<ul>";
foreach($profs as $prof) {
    echo "<li>$prof->nom $prof->prenom</li>";
}
echo "</ul>";

?>

<h2>Ajouter une nouvelle matière</h2>

<form action="Views/nouvelle_matiere.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="id_prof">Professeur :</label>
    <select name="id_prof" id="id_prof" required>
        <?php
        require 'Model/pdo.php';
        $stmt = $dbPDO->prepare("SELECT Id_Prof, nom, prenom FROM Prof");
        $stmt->execute();
        $profs = $stmt->fetchAll(PDO::FETCH_CLASS);
        foreach($profs as $p){
            echo "<option value='$p->Id_Prof'>$p->nom $p->prenom</option>";
        }
        ?>
    </select>

    <button type="submit">Valider</button>
</form>

<h2>Ajouter un nouvel élève</h2>

<form action="Views/nouvel_eleve.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required>

    <label for="id_classe">Classe :</label>
    <select name="id_classe" id="id_classe" required>
        <?php
        require 'Model/pdo.php';
        $stmt = $dbPDO->prepare("SELECT Id_Classes, nom FROM Classes");
        $stmt->execute();
        $classes = $stmt->fetchAll(PDO::FETCH_CLASS);

        foreach($classes as $c){
            echo "<option value='$c->Id_Classes'>$c->nom</option>";
        }
        ?>
    </select>

    <button type="submit">Valider</button>
</form>