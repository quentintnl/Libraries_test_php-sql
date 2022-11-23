<?php 

$user = "blabla";
$pass = "blabla";
$bdd = new PDO('mysql:host=localhost:3306;dbname=bibliotheque', $user, $pass);

$id_livres = $_POST['livre_id'];

$sql_auteur ="SELECT id, titre, auteur_id, genre_id FROM livres WHERE id=". $id_livres . ";";
$livres = $bdd->query($sql_auteur)->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Titre</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>
            </th>
            <th>
                <form action="http://localhost/toto/" method="POST">
                        <input  type="text" name="txt_livre" placeholder="Modifier Livre" value="<?php echo($livres["livre"]); ?>">
                        <input type="hidden" name="id_livre" value=<?php echo($livres["id"]); ?>>
                        <input type="submit" name="btn_livre" value="Modifier !"/>
                </form>
            </th>
        </tr>
</body>
