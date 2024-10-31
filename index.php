
<?php require_once('dbase.php');

$sql= 'SELECT * FROM etudiants ORDER BY id DESC';


//preparation de la requette
//$result=mysqli_query($conn,$sql);

//prepare cest pour evite les expression sql

$req_select = $pdo -> prepare($sql);

//execution de la requette
$req_select ->execute();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>cours Crud 2024</title>


</head>
<body>
    <h1>liste des etudiants</h1>

    <table>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
 

    <tbody>
     <?php
//aller chercher les donnnes 
     while ($donnees = $req_select->fetch(PDO::FETCH_ASSOC)) {
      
      ?>
      
      <tr>
            <td><?= $donnees['nom'];?> </td>
            <td><?= $donnees['prenom'];?> </td>
            <td><?= $donnees['email'];?> </td>
            <td>
                <a class="action update" href="update.php?id=<?= $donnees['id'];?>" >Update</a>
                <a class="action delete" href="delete.php?id=<?= $donnees['id'];?>" onclick = "returm confirm ('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Delete</a>
            </td>
           
        </tr>

        <?php
    }
      ?>

    </tbody>

    </table>
    <a href="create.php" class="lien">Creer un nouveau etudiant</a>
</body>
</html>