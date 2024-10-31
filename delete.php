<?php
require_once('dbase.php');

$message = "";
if(isset($_GET['id']) && is_numeric($_GET['id'])) {  // Vérifie que l'ID est bien numérique pour renforcer la sécurité

    $sql = "DELETE FROM etudiants WHERE id = ?";  // Utilisation de la syntaxe des paramètres nommés
    $id=(int)$_GET['id'];
    //prepare la requette
    $req_supp = $pdo->prepare($sql);

    $req_supp->execute([$id]);


    if ($req_supp->rowCount() > 0) {
        $message = "<p class='success'>Client supprimé</p>";
    } else {
        $message = "<p class='error'>Aucun client trouvé avec cet ID</p>";
    }

} else {
    $message = "<p class='error'>ID invalide ou non spécifié</p>";
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

<h1>Supprimer un Etudiant</h1>

<?php echo $message ;?>

<a class="lien" href="http://localhost/COURS-CRUD-2024/">Retour</a>

</body>
</html>