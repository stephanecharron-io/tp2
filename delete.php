<?php

session_start();

require 'ouvrages.php';

use function Ouvrages\{findAll, findById, replace, create, removeById};

require 'utils.php';

use function Utils\{valider, emptyStringToNull};

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    removeById($_POST['id']);

    $_SESSION["succesSupression"] = true;
    header("Location: index.php", true, 303);
} else {
    http_response_code(400);
    echo "400 Bad Request ";
    exit();
}
?>