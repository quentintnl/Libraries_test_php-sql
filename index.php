<?php
    $user = "blabla";
    $pass = "blabla";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=bibliotheque', $user, $pass);

    function test($valeur) {
        if (isset($valeur) && !empty($valeur) && !is_null(($valeur))){
            return true;
    }
        return false;
    }

    if( test($_POST) ) {
        if( test($_POST["nom"]) && test($_POST["auteur_id"]) && test($_POST["genre_id"]) ) {
            $sql_insert = "INSERT INTO livres (`titre`, `auteur_id`, `genre_id`) VALUES (:nom, :auteur_id, :genre_id);";
            $stmt = $bdd->prepare($sql_insert);
            $stmt->execute(
                [
                    'nom' => $_POST["nom"],
                    'auteur_id'=> $_POST["auteur_id"],
                    'genre_id' => $_POST["genre_id"]
                ]
            );
        }   
    }

    if( test($_POST) ) {
        if( test($_POST["livregenre"]) ) {
            $sql_insert = "INSERT INTO genres (`genrelivre`) VALUES (:livregenre)";
            $stmt = $bdd->prepare($sql_insert);
            $stmt->execute(['livregenre' => $_POST["livregenre"]]);
        }
    }

    if( test($_POST) ) {
        if( test($_POST["auteurnom"]) ) {
            $sql_insert = "INSERT INTO auteurs (`nomauteur`) VALUES (:auteurnom)";
            $stmt = $bdd->prepare($sql_insert);
            $stmt->execute(['auteurnom' => $_POST["auteurnom"]]);echo(5);
        }
    }

    if(isset($_POST['btn_genre'])) {
        $sql_update_genre="UPDATE genres SET genrelivre=:genrelivre WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_genre);
        $stmt->execute(['genrelivre' => $_POST["txt_genre"],'id' => $_POST["id_genre"]]);
    }

    if(isset($_POST['btn_auteur'])) {
        $sql_update_auteur="UPDATE auteurs SET nomauteur=:nomauteur WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_auteur); 
        $stmt->execute(['nomauteur' => $_POST["txt_auteur"],'id' => $_POST["id_auteur"]]);
    }

    if(isset($_POST['btn_livre'])) {
        $sql_update_livre="UPDATE livres SET titre=:titre WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_livre); 
        $stmt->execute(['titre' => $_POST["txt_livre"],'id' => $_POST["id_livre"]]);
    }


    if( isset($_POST["delete_livres"]) ) {
        $sql_delete = "DELETE FROM livres WHERE id = :delete_livres";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['delete_livres' => $_POST["delete_livres"]]);
    }

    if( isset($_POST["delete_genre"]) ) {
        $sql_delete = "DELETE FROM genres WHERE id = :delete_genre";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['delete_genre' => $_POST["delete_genre"]]);
    }

    if( isset($_POST["suprBook"]) ) {
        $sql_delete = "DELETE FROM livres WHERE id =  :suprBook";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['suprBook' => $_POST["suprBook"]]);
    }

    if( isset($_POST["delete_auteur"]) ) {
        $sql_delete = "DELETE FROM auteurs WHERE id = :delete_auteur";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['delete_auteur' => $_POST["delete_auteur"]]);
    }

    $sql = "SELECT * FROM auteurs;";
    $auteurs = $bdd->query($sql)->fetchAll();

    $sql = "SELECT * FROM genres;";
    $genres = $bdd->query($sql)->fetchAll();
    
    $sql = " SELECT livres.id, livres.titre, auteurs.nomauteur, genres.genrelivre
    FROM  livres
    INNER JOIN auteurs, genres 
    WHERE genres.id = genre_id AND auteurs.id = auteur_id ";
    $livres = $bdd->query($sql)->fetchAll();
?>

<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
</head>
<header>
<table border="1">
        <thead>
            <tr>
                <th>Titres</th>
                <th>Auteurs</th>
                <th>Genres</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($livres as $livre):?>
                <tr>
                    <td><?php echo($livre["titre"]); ?></td>
                    <td><?php echo($livre["genrelivre"]); ?></td>
                    <td><?php echo($livre["nomauteur"]); ?></td>
                    <td>
                    <form action="http://localhost/toto/modifier_livre.php" method="POST">
                            <input type="submit" value="Modifier">
                            <input type="hidden" name="livre_id" value=<?php echo ($livre["id"])?>>
                            </form>
                    <form action="" method="POST">
                        <input  type="submit" value="Supprimer">
                        <input type="hidden" name="delete_livres" value=<?php echo ($livre["id"])?>>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Titre du livre">
        <select name="genre_id">
            <option selected> Sélectionner le genre</option>
            <?php foreach($genres as $genress): ?>
                <option value=<?php echo ($genress["id"]);?>><?php echo ($genress["genrelivre"]);?></option> 
        <?php endforeach; ?>
        </select>        
        <select name="auteur_id">
            <option selected> Sélectionner l'auteur</option>
            <?php foreach($auteurs as $auteurss): ?>
                <option value=<?php echo ($auteurss["id"]);?>><?php echo ($auteurss["nomauteur"]);?></option> 
        <?php endforeach; ?>
        </select>
        <input type="submit" value="Envoyer">
    </form>
</header>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Genre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($genres as $genress):?>
                <tr>
                    <td><?php echo($genress["genrelivre"]); ?></td>
                    <td>   
                    <form action="tata.php" method="POST">
                            <input type="submit" value="Modifier">
                            <input type="hidden" name="genre_id" value=<?php echo ($genress["id"])?>>
                            </form>
                        <form action="" method="post">
                            <input type="submit" value="Supprimer">
                            <input type="hidden" name="delete_genre" value=<?php echo ($genress["id"])?>>
                        </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="" method= "post">
        <input type="text" name="livregenre" placeholder="Genre">
        <input type="submit" value="Envoyer">
    </form>
</body>
<div>
<table border="1">
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($auteurs as $auteurss): ?>
                <tr>
                    <td><?php echo($auteurss["nomauteur"]); ?></td>
                    <td>
                        <form action="http://localhost/toto/modifier_auteur.php" method="POST">
                            <input type="submit" value="Modifier">
                            <input type="hidden" name="auteur_id" value=<?php echo ($auteurss["id"])?>>
                        </form>
                        <form action="" method="post">
                            <input type="submit" value="Supprimer">
                            <input type="hidden" name="delete_auteur" value=<?php echo ($auteurss["id"])?>>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="" method= "post">
        <input type="text" name="auteurnom" placeholder="Auteur">
        <input type="submit" value="Envoyer">
    </form>
</div>
</html>