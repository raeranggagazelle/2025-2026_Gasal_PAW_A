<?php
require_once 'validate.inc';

$errors = array();

if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!<br>';
    echo 'Error details:<br>';
    foreach ($errors as $field => $error) {
        echo "- $field: $error<br>";
    }
}
