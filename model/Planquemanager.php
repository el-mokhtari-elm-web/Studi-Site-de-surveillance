<?php 

class Planquemanager extends Dbconnect {

    private $_types = ["Appartement", "Maison", "Entrepot", "Bar", "Boomker"];

    public function getPlanques() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM planques");
            $stmt->execute();
            $rowPlanques = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rowPlanques;
    }

    public function getPlanqueUniq(Planque $newPlanque) {
        $planque = $newPlanque->getPlanque();

        $stmt = self::$_instance_db->prepare("SELECT code, country FROM planques WHERE code = :code AND country = :country");
        $stmt->bindParam(':code', $planque['code']); 
        $stmt->bindParam(':country', $planque['country']); 
            $stmt->execute();
            $rowPlanqueUniq = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rowPlanqueUniq) < 1) {
                $this->insertPlanque($planque); 
            } else {
                return $rowPlanqueUniq;
              }
    }


    public function getPlanque_s($planque) {
        $stmt = self::$_instance_db->prepare("SELECT * FROM planques ON code = :code AND country = :country");
        $stmt->bindParam(':code', $planque['code']); 
        $stmt->bindParam(':country', $planque['country']); 
            $stmt->execute();
            $planque_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $planque_s;
    }


    public function insertPlanque($newPlanque) {
        $stmt = self::$_instance_db->prepare("INSERT INTO planques (code, location_name, country, speciality_type) VALUES (:code, :locationName, :country, :specialityType)");
            
            $code = $this->testStringEntry(htmlspecialchars(trim($newPlanque['code'])));
            $stmt->bindParam(':code', $code);

            $locationName = $this->testTextEntry(htmlspecialchars(trim($newPlanque['location_name'])));
            $stmt->bindParam(':locationName', $locationName);
            
            if (array_key_exists(trim($newPlanque['countrys']), self::$_countrys_nationalitys)) {
                $country = $this->testStringEntry(htmlspecialchars($newPlanque['countrys']));
                $stmt->bindParam(':country', $country);
            } else {
                return;
            }

            if (in_array(trim($newPlanque['specialitys_type']), $this->_types)) {
                $specialityType = $this->testStringEntry(htmlspecialchars($newPlanque['specialitys_type']));
                $stmt->bindParam(':specialityType', $specialityType);
            } else {
                return;
            }

                $stmt->execute();
                return;
    }

    public function deletePlanque($id) {    
        $stmt = self::$_instance_db->prepare('DELETE from planques WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}