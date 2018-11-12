<?php

session_start();

require 'ouvrages.php';

use function Ouvrages\{findAll, findById, replace, create, removeById};

require 'utils.php';

use function Utils\{valider, emptyStringToNull};

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = valider($_POST);

    if (count($errors) > 0) {

        $_SESSION['anneeParution'] = $_POST['anneeParution'];
        $_SESSION['auteurs'] = $_POST['auteurs'];
        $_SESSION['editeur'] = $_POST['editeur'];
        $_SESSION['edition'] = $_POST['edition'];
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['isbn'] = $_POST['isbn'];
        $_SESSION['sousTitre'] = $_POST['sousTitre'];
        $_SESSION['supports'] = $_POST['supports'] == null ? [] : $_POST['supports'];
        $_SESSION['titre'] = $_POST['titre'];

        $_SESSION["errors"] = $errors;
        header("Location: edit.php?id=" . $_POST['id'], true, 303);
    } else {

        $ouvrage['anneeParution'] = emptyStringToNull($_POST['anneeParution']);
        $ouvrage['auteurs'] = emptyStringToNull($_POST['auteurs']);
        $ouvrage['editeur'] = emptyStringToNull($_POST['editeur']);
        $ouvrage['edition'] = emptyStringToNull($_POST['edition']);
        $ouvrage['id'] = emptyStringToNull($_POST['id']);
        $ouvrage['isbn'] = emptyStringToNull($_POST['isbn']);
        $ouvrage['sousTitre'] = emptyStringToNull($_POST['sousTitre']);
        $ouvrage['supports'] = $_POST['supports'];
        $ouvrage['titre'] = emptyStringToNull($_POST['titre']);

        replace($ouvrage['id'], $ouvrage);

        $_SESSION["succesModif"] = true;
        header("Location: show.php?id=" . $_POST['id'], true, 303);
    }
} else {
    http_response_code(400);
    echo "400 Bad Request ";
    exit();
}
?>