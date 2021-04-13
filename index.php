<?php

session_start();
$_SESSION["date"] = Date("d - m - y");

require_once("config/config.php");

require_once("view/heading.php");

require_once("view/header_home.php");

require_once("model/Dbconnect.php");
$dbName = new PDO(DSN , DB_USER, DB_PASS);

require_once("model/Missionmanager.php");
$missions = new Missionmanager($dbName);
$rowMissions = $missions->getMissions();

require_once("view/body_home.php");

require_once("view/footer.php");




