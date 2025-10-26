<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }
    
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf alfabet, tanda hubung, dan apostrof";
        return false;
    }
    
    return true;
}

function validateEmail($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }
    
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid";
        return false;
    }
    
    return true;
}

function validateAge($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }
    
    if (!is_numeric($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name harus berupa angka";
        return false;
    }
    
    $age = intval($field_list[$field_name]);
    if ($age < 1 || $age > 120) {
        $errors[$field_name] = "Umur harus antara 1 dan 120 tahun";
        return false;
    }
    
    return true;
}

function validatePhone($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }
    
    $pattern = "/^[0-9+\-\s()]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Format nomor telepon tidak valid";
        return false;
    }
    
    return true;
}

function validateURL($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }
    
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_URL)) {
        $errors[$field_name] = "Format URL tidak valid";
        return false;
    }
    
    return true;
}
?>
