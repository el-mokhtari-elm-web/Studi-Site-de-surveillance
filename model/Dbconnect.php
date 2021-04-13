<?php 

class Dbconnect {

protected static $_instance_db;
protected static $_countrys_nationalitys = ["France" => "Française", "Italie" => "Italienne", "Angleterre" => "Anglaise", "Allemagne" => "Allemande", "Russie" => "Russe", "Chine" => "Chinoise", "Japon" => "Japonaise", "Suisse" => "Suisse", "Etats Unis" => "Américaine", "Espagne" => "Espagnole"];

    public function __construct(PDO $db) {
        $this->setInstanceDb($db);
    }

    public function getCountrys() {
        return self::$_countrys_nationalitys;
    }

    public function setInstanceDb($db) {
        if (is_null(self::$_instance_db)) {
        self::$_instance_db = $db;
        } else {
            return self::$_instance_db;
        }
    }

    public function testStringEntry($entry) {
        $item = strlen($entry);
        if (($item > 0) AND ($item < 200)) {
            return $entry;
        } else {
            header('Location: ' .ADMIN);
            exit;
        }
    }

    public function testTextEntry($entry) {
        $item = strlen($entry);
        if (($item > 0) AND ($item < 1000)) {
            return $entry;
        } else {
            header('Location: ' .ADMIN);
            exit;
        }
    }

}

require_once("Adminmanager.php");

require_once("Agentmanager.php");

require_once("Ciblemanager.php");

require_once("Contactmanager.php");

require_once("Planquemanager.php");

require_once("Nationalitys.php");



