<?php
session_start();

if ((isset($_SESSION["sessionId"])) && ($_SESSION["sessionId"] === session_id())) {

    if (isset($_POST["logout"])) {
        if (isset($_POST["hidden"])) {
            session_regenerate_id();
            session_destroy();

            header("Location: ../index.php");
            exit;
        }
    }
    
} else {
    header("Location: ../index.php");
    exit;
  }