<?php



require 'ouvrages.php';
use function Ouvrages\{findAll, findById, replace, create, removeById};

require 'utils.php';
use function Utils\{getTitreEditionFromOuvrage, printHeader};

$ouvrages = findAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Bliblogaraphie</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700');
    </style>
    <link rel="stylesheet" href="style.css" type="text/css"/>

</head>
<body>

<?php printHeader(); ?>


<main>
    <section>
        <h1 class="oswald-bold">Bibliothèque</h1>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Titre et édition</th>
                <th>Auteur</th>
                <th>Support</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php  foreach($ouvrages as $key =>$ouvrage){ ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo getTitreEditionFromOuvrage($ouvrage) ?></td>
                <td><?php echo $ouvrage['auteurs'] ?></td>
                <td><?php echo join(', ', $ouvrage['supports']) ?></td>
                <td><a href="show.php?id=<?php echo $ouvrage['id'] ?>">Afficher</a></td>
            </tr>
            <?php } ?>
            </tbody>

        </table>
        <div class="buttonWrap">
            <button type="submit"><a href="create.php">Ajouter</a></button>
        </div>
    </section>

</main>

</body>
</html>