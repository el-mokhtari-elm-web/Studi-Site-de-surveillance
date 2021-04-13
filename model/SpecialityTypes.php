<?php

class SpecialityTypes extends Dbconnect {

    public function getSpecialityTypes() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM specialitys");
            $stmt->execute();
            $rowSpecialityTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rowSpecialityTypes;
    }

}