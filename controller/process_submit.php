<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

if ((empty($email) && (empty($password)))) {
    header('Location: ' .ACCUEIL. '?message=empty');
    exit;
} else if (((strlen($email) > 34) || (strlen($password) > 34)) OR ((strlen($email) < 6) || (strlen($password) < 7))) {
    header('Location: ' .ACCUEIL. '?message=incomplete');
    exit;
  } 


