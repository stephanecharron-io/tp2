<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require 'utils.php';

use function Utils\{printHeader, supportChecked, printErreur};

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

<?php printHeader(); ?>

<?php printErreur(); ?>

<main>
    <section>
        <h1>Nouvel ouvrage</h1>
        <h2 class="sousTitre"><?php echo $ouvrage['sousTitre'] ? $ouvrage['sousTitre'] : '&nbsp;' ?></h2>
        <form method="post" action="update.php">
            <table>
                <tbody>
                <tr>
                    <td><label for="titre">titre <sup>*</sup></label></td>
                    <td><input type="text" name="titre" id="titre" value="<?php echo $ouvrage['titre'] ?>"/></td>
                </tr>
                <tr>
                    <td><label for="sousTitre">sous titre</label></td>
                    <td><input type="text" name="sousTitre" id="sousTitre" value="<?php echo $ouvrage['sousTitre'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><label for="auteurs">auteurs <sup>*</sup></label></td>
                    <td><input type="text" name="auteurs" id="auteurs" value="<?php echo $ouvrage['auteurs'] ?>"/></td>
                </tr>
                <tr>
                    <td><label for="anneeParution">année parution</label></td>
                    <td><input type="text" name="anneeParution" id="anneeParution"
                               value="<?php echo $ouvrage['anneeParution'] ?>"/></td>
                </tr>
                <tr>
                    <td><label for="edition">edition</label></td>
                    <td><input type="text" name="edition" id="edition" value="<?php echo $ouvrage['edition'] ?>"/></td>
                </tr>
                <tr>
                    <td><label for="editeur">editeur <sup>*</sup></label></td>
                    <td><input type="text" name="editeur" id="editeur" value="<?php echo $ouvrage['editeur'] ?>"/></td>
                </tr>
                <tr>
                    <td><label for="isbn">isbn</label></td>
                    <td><input type="text" name="isbn" id="isbn" value="<?php echo $ouvrage['isbn'] ?>"/></td>
                </tr>
                <tr>
                    <td>supports <sup>*</sup></td>
                    <td class="supports">
                        <input <?php echo supportChecked($ouvrage, 'pdf') ?> type="checkbox" name="supports[]" id="pdf"
                                                                             value="pdf"> <label for="pdf">pdf</label>
                        <input <?php echo supportChecked($ouvrage, 'papier') ?> type="checkbox" name="supports[]"
                                                                                id="papier" value="papier"> <label
                                for="papier">papier</label>
                        <input <?php echo supportChecked($ouvrage, 'kindle') ?> type="checkbox" name="supports[]"
                                                                                id="kindle" value="kindle"> <label
                                for="kindle">kindle</label>
                        <input <?php echo supportChecked($ouvrage, 'epub') ?> type="checkbox" name="supports[]"
                                                                              id="epub" value="epub"> <label for="epub">epub</label>
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