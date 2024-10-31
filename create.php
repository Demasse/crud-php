 <?php 
require_once('dbase.php');

$message='';
function clean_input($data){

    // $data = trim($data);
    // $data = stripcslashes($data);
    // $data = htmlspecialchars($data);
    // return data;

    return htmlspecialchars(stripslashes(trim(($data))));
}




//on pose une condition pour verifie soi l'utilisateur a clicker sur le button

if (isset($_POST['create'])){

    //nettoyage des entrees pour eviter les injections SQL
    $nom = clean_input( $_POST['nom']) ;
    $prenom = clean_input( $_POST['prenom']) ; // Correction : récupérer la valeur du champ "prenom"
    $email = clean_input( $_POST['email']) ; // Correction : récupérer la valeur du champ "mail"

// verfication si ladresse email exist


if((empty($nom)) || (empty($prenom)) || (empty($email)) ){

    $message = '<p class="error"> Veuilllez remplir les champs</p> ';
 }
 else{
 // Création de la requête SQL pour insérer un nouvel étudiant
 $sql= 'INSERT INTO `etudiants`(`nom`, `prenom`, `email`) VALUES (?, ?, ?)';

 // Préparation de la requête
 $req_select = $pdo->prepare($sql);

 // Exécution de la requête avec les valeurs récupérées
 $req_select->execute([$nom, $prenom, $email]);

 echo 'Etudiant créé avec succès';
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Créer un nouveau étudiant</h1>
    <?= $message ?>
    <form action="" method="post">
        <input type="text" name="nom" placeholder="Nom">
        <br><br>
        <input type="text" name="prenom" placeholder="Prénom">
        <br><br>
        <input type="email" name="email" placeholder="email ptt">
        <br><br>
        <input type="submit" name="create" value="Créer">
    </form>

    <a href="http://localhost/COURS-CRUD-2024/" class="lien">Retour</a>
</body>
</html>