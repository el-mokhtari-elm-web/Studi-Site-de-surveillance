<?php
$dbName = new PDO(DSN , DB_USER, DB_PASS);

require_once("../model/Admin.php");
require_once("../model/Dbconnect.php");

if ((isset($_SESSION["uniqId"]) && ($_SESSION["sessionId"]) === session_id())) {
    $validateCheck = true;
    return $validateCheck;
} else {
    $grainSaltSession = uniqid();
    $grainSaltPassword = "#AKph780MP5/*5dchhww0?/#lPOO";

        $email = htmlspecialchars(trim($_POST["email"]));
        $password = md5(htmlspecialchars($_POST["password"]).$grainSaltPassword);

            $newAdmin = new Admin($email, $password);

            $admin = new Adminmanager($dbName);
            $adminVerified = $admin->getAdminChecked($newAdmin);

            $bigPassWord = $grainSaltSession.session_id();
            
                if (($bigPassWord === $grainSaltSession.session_id()) && ($adminVerified[0]["level_right"] === "high") && (!isset($_SESSION["uniqId"]))) {
                $validateCheck = true;
                } else {
                    $validateCheck = false;
                }
    }

    return $validateCheck;