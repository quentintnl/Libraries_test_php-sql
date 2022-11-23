<?php 

$user = "blabla";
$pass = "blabla";
$bdd = new PDO('mysql:host=localhost:3306;dbname=bibliotheque', $user, $pass);

$id_genre = $_POST['genre_id'];

$sql_genre ="SELECT id, genrelivre FROM genres WHERE id=". $id_genre . ";";
$genre = $bdd->query($sql_genre)->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Genre</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>
            </th>
            <th>
                <form action="http://localhost/toto/" method="POST">
                        <input  type="text" name="txt_genre" placeholder="Modifier Genre" value="<?php echo($genre["genre"]); ?>">
                        <input type="hidden" name="id_genre" value=<?php echo($genre["id"]); ?>>
                        <input type="submit" name="btn_genre" value="Modifier !"/>
                </form>
            </th>
        </tr>
</body>