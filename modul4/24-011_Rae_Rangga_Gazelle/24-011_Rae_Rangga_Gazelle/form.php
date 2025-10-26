<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validasi</title>
</head>
<body>
<?php
require_once 'validate.inc';

$errors = array();
$hasFormData = !empty($_POST);

if ($hasFormData) {
    $isValid = true;
    $isValid &= validateName($_POST, 'surname', $errors);
    $isValid &= validateEmail($_POST, 'email', $errors);
    $isValid &= validateAge($_POST, 'age', $errors);
    $isValid &= validatePhone($_POST, 'phone', $errors);
    $isValid &= validateURL($_POST, 'website', $errors);
    
    if (!$isValid) {
        echo '<h2>Error dalam Form</h2>';
        echo 'Error details:<br>';
        foreach ($errors as $field => $error) {
            echo "- $field: $error<br>";
        }
        echo '<br>';
    } else {
        echo '<h2>Form submitted successfully with no errors</h2>';
        echo 'Data yang berhasil disubmit:<br>';
        echo '- Surname: ' . htmlspecialchars($_POST['surname']) . '<br>';
        echo '- Email: ' . htmlspecialchars($_POST['email']) . '<br>';
        echo '- Age: ' . htmlspecialchars($_POST['age']) . '<br>';
        echo '- Phone: ' . htmlspecialchars($_POST['phone']) . '<br>';
        echo '- Website: ' . htmlspecialchars($_POST['website']) . '<br><br>';
    }
} else {
    echo '<h2>Form Validasi Lengkap</h2>';
}

include 'form.inc';
?>
</body>
</html>
