<?php
namespace Utils;

function getTitreEditionFromOuvrage($ouvrage) {
    $out = isset($ouvrage['titre'])  ? $ouvrage['titre'] : '';
    if (isset($ouvrage['edition']) && $ouvrage['edition'] > 0) {
        $out .= ', ';
        if($ouvrage['edition'] == 1){
            $out .= 'first';
        } else {
            $out .= $ouvrage['edition'].'th';
        }

        $out .= ' ed.';
    }
    return $out;
}

function printHeader (){
    echo<<<_HTML
    <header>
        <menu>
            <ul>
                <li><a href="index.php">Accueil</a></li>
            </ul>
        </menu>
    </header>
_HTML;
}

function supportChecked ($ouvrage, $support) {
    if($ouvrage == null) return "";
    if (in_array($support, $ouvrage ['supports'])) {
        return "checked";
    }
    return "";
}

define("MSG_ERREUR", array(
    "isbn" => array(
        "id" => 7,
        "msg" => "Si présent, ne peut pas être vide et doit être entièrement constituté de chiffres."
    ),
    "titre" => array(
        "id" => 1,
        "msg" => "Obligatoire. Ne peut pas être vide."
    ),
    "sousTitre" => array(
        "id" => 2,
        "msg" => "Si présent, ne peut pas être vide."
    ),
    "auteurs" => array(
        "id" => 3,
        "msg" => "Obligatoire. Ne peut pas être vide."
    ),
    "supports" => array(
        "id" => 8,
        "msg" => "Obligatoire. Ne peut pas être vide. Peut avoir plus d'un item. Les valeurs possibles des items sont kindle, epub, papier et pdf."
    ),
    "editeur" => array(
        "id" => 6,
        "msg" => "Obligatoire. Ne peut pas être vide."
    ),
    "edition" => array(
        "id" => 5,
        "msg" => "Nombre entier positif."
    ),
    "anneeParution" => array(
        "id" => 4,
        "msg" => "Nombre entier positif. Obligatoire."
    )
));

function valider($post) {

    $error = array();

    if (isset($post['isbn']) && $post['isbn'] != null) {
        if (!is_numeric($post['isbn'])) {
            array_push($error, 'isbn');
        }
    }

    if (empty(trim($post['titre']))) {
        array_push($error, 'titre');
    }

    if (!empty($post['sousTitre'])) {
        if(strlen(trim($post['sousTitre'])) == 0) {
            array_push($error, 'sousTitre');
        }
    }

    if (empty(trim($post['auteurs']))) {
        array_push($error, 'auteurs');
    }


    if(!isset($post['supports'])){
        array_push($error, 'supports');
    } else {
        foreach ($post['supports'] as $supprt) {
            if(!in_array($supprt , $post['supports'])) {
                array_push($error, 'supports');
            }
        }
    }

    if (empty(trim($post['editeur']))) {
        array_push($error, 'editeur');
    }

    if(isset($post['edition']) && !empty($post['edition'])){
        if(!is_numeric($post['edition'])){
            array_push($error, 'edition');
        }
    }

    if (empty(trim($post['anneeParution'])) || !is_numeric($post['anneeParution']) ) {
        array_push($error, 'anneeParution');
    }
    return $error;

}

function nullToEmptyString ($field){
    return $field == null ? "" : $field;
}

function emptyStringToNull ($field) {
    return $field == "" ? null : $field;
}


function printErreur ($errors) {
    usort($errors, function ($a, $b) { return  MSG_ERREUR[$a]['id'] <=> MSG_ERREUR[$b]['id']; });

    echo '<div class="erreur">';
        echo '<ul>';
        foreach ($errors as $error){

            echo '<li>(' . MSG_ERREUR[$error]['id'] . ') ' . MSG_ERREUR[$error]['msg'];
            echo '</li>';
        }
        echo '</ul>';
    echo '</div>';

}

function printSuccesModif () {

    echo '<div class="succes">';
    echo '<ul>';
    echo '<li>La modification a été faite avec succès';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
}

function getFieldErrorClass ($field, $errors){
     return in_array($field, $errors) ? "error" : "";
}

function getErrorIndex ($field, $errors){
    return in_array($field, $errors) ? "(".MSG_ERREUR[$field]['id'].")" : "";
}