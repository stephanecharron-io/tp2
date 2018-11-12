<?php

session_start();

require 'ouvrages.php';

use function Ouvrages\{findAll, findById, replace, create, removeById};

require 'utils.php';

use function Utils\{printHeader, supportChecked, printErreur, getFieldErrorClass, getErrorIndex};

$ouvrage = null;


$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

if (sizeof($errors)) {
    $ouvrage['anneeParution'] = $_SESSION['anneeParution'];
    $ouvrage['auteurs'] = $_SESSION['auteurs'];
    $ouvrage['editeur'] = $_SESSION['editeur'];
    $ouvrage['edition'] = $_SESSION['edition'];
    $ouvrage['id'] = $_SESSION['id'];
    $ouvrage['isbn'] = $_SESSION['isbn'];
    $ouvrage['sousTitre'] = $_SESSION['sousTitre'];
    $ouvrage['supports'] = $_SESSION['supports'];
    $ouvrage['titre'] = $_SESSION['titre'];
}

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvel ouvrage</title>

        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700');
        </style>
        <link rel="stylesheet" href="style.css" type="text/css"/>

    </head>
    <body class="show">

    <?php printHeader();

    if (count($errors)) {
        printErreur($errors);
    }
    ?>

    <main>
        <section>
            <h1>Nouvel ouvrage</h1>
            <h2 class="sousTitre">&nbsp;</h2>
            <form method="post" action="save.php">
                <table>
                    <tbody>
                    <tr class="<?php echo getFieldErrorClass('titre', $errors) ?>">
                        <td><label for="titre">titre <sup>*</sup> <?php echo getErrorIndex('titre', $errors) ?>
                            </label></td>
                        <td><input type="text" name="titre" id="titre" value="<?php echo $ouvrage['titre'] ?>"/>
                        </td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('sousTitre', $errors) ?>">
                        <td><label for="sousTitre">sous
                                titre <?php echo getErrorIndex('sousTitre', $errors) ?></label></td>
                        <td><input type="text" name="sousTitre" id="sousTitre"
                                   value="<?php echo $ouvrage['sousTitre'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('auteurs', $errors) ?>">
                        <td><label for="auteurs">auteurs
                                <sup>*</sup> <?php echo getErrorIndex('auteurs', $errors) ?></label></td>
                        <td><input type="text" name="auteurs" id="auteurs"
                                   value="<?php echo $ouvrage['auteurs'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('anneeParution', $errors) ?>">
                        <td><label for="anneeParution">année
                                parution <sup>*</sup><?php echo getErrorIndex('anneeParution', $errors) ?></label></td>
                        <td><input type="text" name="anneeParution" id="anneeParution"
                                   value="<?php echo $ouvrage['anneeParution'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('edition', $errors) ?>">
                        <td><label for="edition">edition <?php echo getErrorIndex('edition', $errors) ?></label>
                        </td>
                        <td><input type="text" name="edition" id="edition"
                                   value="<?php echo $ouvrage['edition'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('editeur', $errors) ?>">
                        <td><label for="editeur">editeur
                                <sup>*</sup> <?php echo getErrorIndex('editeur', $errors) ?></label></td>
                        <td><input type="text" name="editeur" id="editeur"
                                   value="<?php echo $ouvrage['editeur'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('isbn', $errors) ?>">
                        <td><label for="isbn">isbn <?php echo getErrorIndex('isbn', $errors) ?></label></td>
                        <td><input type="text" name="isbn" id="isbn" value="<?php echo $ouvrage['isbn'] ?>"/></td>
                    </tr>
                    <tr class="<?php echo getFieldErrorClass('supports', $errors) ?>">
                        <td>supports <sup>*</sup> <?php echo getErrorIndex('supports', $errors) ?></td>
                        <td class="supports">
                            <input <?php echo supportChecked($ouvrage, 'pdf') ?> type="checkbox" name="supports[]"
                                                                                 id="pdf" value="pdf"> <label
                                    for="pdf">pdf</label>
                            <input <?php echo supportChecked($ouvrage, 'papier') ?> type="checkbox"
                                                                                    name="supports[]" id="papier"
                                                                                    value="papier"> <label
                                    for="papier">papier</label>
                            <input <?php echo supportChecked($ouvrage, 'kindle') ?> type="checkbox"
                                                                                    name="supports[]" id="kindle"
                                                                                    value="kindle"> <label
                                    for="kindle">kindle</label>
                            <input <?php echo supportChecked($ouvrage, 'epub') ?> type="checkbox" name="supports[]"
                                                                                  id="epub" value="epub"> <label
                                    for="epub">epub</label>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="buttonWrap">
                    <a href="index.php" class="annuler">Annuler</a>
                    <button type="submit">Sauvegarder</button>
                </div>
            </form>
        </section>
    </main>
    </body>
    </html>
<?php
session_unset();
session_destroy();
?>