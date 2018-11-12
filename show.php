<?php

require 'ouvrages.php';

use function Ouvrages\{findAll, findById, replace, create, removeById};

require 'utils.php';

use function Utils\{printHeader, printSuccesModif, printSuccesCreate};

session_start();

$ouvrage = null;

if (isset($_GET['id'])) {
    $ouvrage = findById(intval($_GET['id']));
}

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>
            <?php if ($ouvrage) {
                echo $ouvrage['titre'];
            } else {
                echo 'erreur: ouvrage inexistant!';
            } ?>
        </title>

        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700');
        </style>
        <link rel="stylesheet" href="style.css" type="text/css"/>

    </head>
    <body class="show">

    <?php
    printHeader();

    if (isset($_SESSION['succesModif'])) {
        printSuccesModif();
    } elseif (isset($_SESSION['succesCreate'])) {
        printSuccesCreate();
    }
    ?>
    <main>
        <section>

            <?php if ($ouvrage): ?>

                <h1><?php echo $ouvrage['titre'] ?></h1>
                <h2 class="sousTitre"><?php echo $ouvrage['sousTitre'] ? $ouvrage['sousTitre'] : '&nbsp;' ?></h2>
                <table>
                    <tbody>
                    <tr>
                        <td>titre</td>
                        <td><?php echo $ouvrage['titre'] ?></td>
                    </tr>
                    <tr>
                        <td>sous titre</td>
                        <td><?php echo $ouvrage['sousTitre'] ? $ouvrage['sousTitre'] : '' ?></td>
                    </tr>
                    <tr>
                        <td>auteurs</td>
                        <td><?php echo $ouvrage['auteurs']; ?></td>
                    </tr>
                    <tr>
                        <td>année parution</td>
                        <td><?php echo $ouvrage['anneeParution']; ?></td>
                    </tr>
                    <tr>
                        <td>edition</td>
                        <td><?php echo $ouvrage['edition'] ? $ouvrage['edition'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>editeur</td>
                        <td><?php echo $ouvrage['editeur']; ?></td>
                    </tr>
                    <tr>
                        <td>isbn</td>
                        <td><?php echo $ouvrage['isbn']; ?></td>
                    </tr>
                    <tr>
                        <td>supports</td>
                        <td><?php echo join(', ', $ouvrage['supports']) ?></td>
                    </tr>
                    </tbody>
                </table>
                <div class="buttonWrap">
                    <button type="submit"><a href="edit.php?id=<?php echo $ouvrage['id'] ?>">Modifier</a></button>
                    <form method="post" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $ouvrage['id'] ?>"/>
                        <button type="submit">Supprimer</button>
                    </form>
                </div>

            <?php else: ?>
                <h1 class="error">Ouvrage inexistant!</h1>
            <?php endif; ?>
        </section>
    </main>
    </body>
    </html>
<?php
session_unset();
session_destroy();

?>