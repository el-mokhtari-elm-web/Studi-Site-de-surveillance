<?php
session_start();
require_once("../config/config.php");

if (isset($_POST["submit"])) {
    require_once("../controller/process_submit.php");
}   

if (isset($_SESSION)) {
        require_once("../controller/process_login.php");

        if ($validateCheck === true) {

            require_once("../view/heading.php");

            require_once("../view/header_admin.php");
        
            require_once("../view/body_admin.php");
        
            require_once("../view/footer.php");

        } else {
            header('Location: ' .ACCUEIL);
            exit;
          } 

} 



