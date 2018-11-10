<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'utils.php';

use function Utils\{valider, emptyStringToNull};

$ouvrage = array();

$ouvrage['anneeParution'] = emptyStringToNull($_POST['anneeParution']);
$ouvrage['auteurs'] = emptyStringToNull($_POST['auteurs']);
$ouvrage['editeur'] = emptyStringToNull($_POST['editeur']);
$ouvrage['edition'] = emptyStringToNull($_POST['edition']);
$ouvrage['id'] = emptyStringToNull($_POST['id']);
$ouvrage['isbn'] = emptyStringToNull($_POST['isbn']);
$ouvrage['sousTitre'] = emptyStringToNull($_POST['sousTitre']);
$ouvrage['supports'] = $_POST['supports'];

echo '<pre>';
var_dump($_POST);
echo '</pre>';

print_r (valider($_POST));

?>