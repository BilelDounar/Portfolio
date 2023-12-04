<?php

function cleanXss($key)
{
    return trim(strip_tags($_POST[$key]));
}

function validText($err, $value, $keyErr, $min, $max)
{
if (!empty($value)) {
if (mb_strlen($value) < $min) {
$err[$keyErr] = 'Veuillez renseigner au moins ' . $min . ' caractères';
} elseif (mb_strlen($value) > $max) {
$err[$keyErr] = 'Veuillez renseigner pas plus de ' . $max . ' caractères';
}
} else {
$err[$keyErr] = 'Veuillez renseigner ce champ';
}
return $err;
}


function validmail($errors,$valeur,$key){
    if(!empty($valeur)) {
        if (!filter_var($valeur, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valide';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}

function getPostValue($key)
{
    if (!empty($_POST[$key])) {
        echo $_POST[$key];
    }
}

function viewError($err, $key)
{
    if (!empty($err[$key])) {
        echo $err[$key];
    }
}