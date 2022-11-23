<?php 

$user = "blabla";
$pass = "blabla";
$bdd = new PDO('mysql:host=localhost:3306;dbname=bibliotheque', $user, $pass);

$id_auteur = $_POST['auteur_id'];

$sql_auteur ="SELECT id, nomauteur FROM auteurs WHERE id=". $id_auteur . ";";
$auteur = $bdd->query($sql_auteur)->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Auteur</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>
            </th>
            <th>
                <form action="http://localhost/toto/" method="POST">
                        <input  type="text" name="txt_auteur" placeholder="Modifier Auteur" value="<?php echo($auteur["auteur"]); ?>">
                        <input type="hidden" name="id_auteur" value=<?php echo($auteur["id"]); ?>>
                        <input type="submit" name="btn_auteur" value="Modifier !"/>
                </form>
            </th>
        </tr>
</body>
