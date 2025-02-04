<?php
require_once('dbase.php');

$message='';
// Récupération des informations de l'étudiant à modifier
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $sql = "SELECT * FROM etudiants WHERE id = ?";
    $eq_select = $pdo->prepare($sql);
    $var_clientID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $eq_select->execute([$var_clientID]);
    $donnees = $eq_select->fetch(PDO::FETCH_ASSOC);

    // Récupération des données
    $nom = $donnees['nom'] ?? "";
    $prenom = $donnees['prenom'] ?? "";
    $email = $donnees['email'] ?? "";
}

// Vérification et nettoyage des entrées
function clean_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

// Mise à jour des informations de l'étudiant
if (isset($_POST['update'])) {

    // Nettoyage des entrées
    $var_nom = clean_input(filter_input(INPUT_POST, 'nom', FILTER_DEFAULT));
    $var_prenom = clean_input(filter_input(INPUT_POST, 'prenom', FILTER_DEFAULT));
    $var_email = clean_input(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $var_clientID = clean_input(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT));

    // Validation des données
    if (empty($var_nom) || empty($var_prenom) || empty($var_email)) {
        $message = "<p style='color: #fff;padding:20px; background:red;margin-top:10px; width:400px'> Veuillez remplir tous les champs du formulaire !</p>";
    } else {

        // Préparation de la requête SQL et mise à jour de l'etudiant dans la base de données
        $sqlModification = "UPDATE etudiants SET  nom = ?, prenom = ?, email = ? WHERE id = ?";
        $eq_modif = $pdo->prepare($sqlModification);

        // Exécution de la requête
        $eq_modif->execute([$var_nom, $var_prenom, $var_email, $var_clientID]);

        // Message de succès
        $message = "<p style='text-align:center; color: #fff;padding:20px; background:green;margin-top:10px; width:300px'> Étudiant modifié avec success</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>PHP & SQL</title>
</head>
<body>
    <h1>MODIFIER UN ETUDIANT</h1>
    <?= $message; ?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
        <br><br>
        <input type="text" name="nom" value="<?= $nom; ?>">
        <br><br>
        <input type="text" name="prenom" value="<?= $prenom; ?>">
        <br><br>
        <input type="email" name="email" value="<?= $email ?>">
        <br><br>
        <input type="submit" name="update" value="Modifier">
    </form>

    <a class="lien" href="http://localhost/COURS-CRUD-2024/">retour</a>
</body>
</html>