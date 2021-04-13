<?php

require_once("../config/config.php");
$dbName = new PDO(DSN , DB_USER, DB_PASS);
require_once("../model/Dbconnect.php");

require_once("../model/Agent.php");
require_once("../model/Agentmanager.php");

require_once("../model/Contact.php");
require_once("../model/Contactmanager.php");

require_once("../model/Cible.php");
require_once("../model/Ciblemanager.php");

require_once("../model/Planque.php");
require_once("../model/Planquemanager.php");

$agent = new Agentmanager($dbName);

        if ((isset($_POST["submit_agent"]) && (isset($_POST["speciality_s"])) && (count($_POST["speciality_s"]) > 0))) {
                $countSpeciality_s = count($_POST["speciality_s"]);
                $newAgent = new Agent($_POST);
                $agentVerified = $agent->getAgentUniq($newAgent, $countSpeciality_s);
        } 
    
        if (isset($_POST["update"])) { 
                foreach ($_POST["speciality_s"] as $agentId => $specialitys) {
                        foreach ($specialitys as $key => $speciality) {
                                $agentVerified = $agent->insertSpeciality($speciality, $agentId);
                        }
                }
        }

        if (isset($_POST["submit_contact"])) {
                $newContact = new Contact($_POST);
                $contact = new Contactmanager($dbName);
                $contactVerified = $contact->getContactUniq($newContact);
        }

        if (isset($_POST["submit_cible"])) {
                $newCible = new Cible($_POST);
                $cible = new Ciblemanager($dbName);
                $cibleVerified = $cible->getCibleUniq($newCible);
        }        

        if (isset($_POST["submit_planque"])) {
                $newPlanque = new Planque($_POST);
                $planque = new Planquemanager($dbName);
                $planqueVerified = $planque->getPlanqueUniq($newPlanque);
        }   

        header('Location: ' .ADMIN);
        exit;





