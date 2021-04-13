<!DOCTYPE html>
<html lang="fr">

<head>
    <title>elm-monitor</title>

    <meta charset="utf-8">
    <meta name="description" content="La surveillance: agence de surveillance">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BOOTSTRAP; ?>">
    <link rel="stylesheet" href="<?php echo STYLE; ?>">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="<?php echo STYLE_SM; ?>">
    <script src="<?php if (($_SERVER["REQUEST_URI"] === ADMIN) || ($_SERVER["REQUEST_URI"] === CONTACT) || ($_SERVER["REQUEST_URI"] === PAGE)) {echo SCRIPT_ADMIN;} else {echo SCRIPT_INDEX;} ?>"></script>
</head>

<body>