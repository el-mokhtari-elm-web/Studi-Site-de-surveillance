<?php

class Nationalitys extends Dbconnect {

    public function getNationalitys() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM nationalitys");
            $stmt->execute();
            $rowNationalitys = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rowNationalitys;
    }

}