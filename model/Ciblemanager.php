<?php 

class Ciblemanager extends Dbconnect {

    public function getCibles() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM cibles");
            $stmt->execute();
            $rowCibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rowCibles;
    }

    public function getCibleUniq(Cible $newCible) {
        $cible = $newCible->getCible();

        $stmt = self::$_instance_db->prepare("SELECT last_name, first_name, code_name, nationality FROM cibles WHERE last_name = :lastName AND first_name = :firstName AND code_name = :codeName");
        $stmt->bindParam(':lastName', $cible['last_name']); 
        $stmt->bindParam(':firstName', $cible['first_name']); 
        $stmt->bindParam(':codeName', $cible['code_name']);
            $stmt->execute();
            $rowCibleUniq = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rowCibleUniq) < 1) {
                $this->insertCible($cible); 
            } else {
                return $rowCibleUniq;
              }
    }


    public function getCible_s($cible) {
        $stmt = self::$_instance_db->prepare("SELECT * FROM cibles ON last_name = :lastName AND first_name = :firstName AND code_name = :codeName");
        $stmt->bindParam(':lastName', $cible['last_name']); 
        $stmt->bindParam(':firstName', $cible['first_name']); 
        $stmt->bindParam(':codeName', $cible['code_name']);
            $stmt->execute();
            $rowCible_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rowCible_s;
    }


    public function insertCible($newCible) {
        $stmt = self::$_instance_db->prepare("INSERT INTO cibles (last_name, first_name, code_name, nationality, date_of_birth) VALUES (:lastName, :firstName, :codeName, :nationality, :dateOfBirth)");
            
            $lastName = $this->testStringEntry(htmlspecialchars(trim($newCible['last_name'])));
            $stmt->bindParam(':lastName', $lastName);

            $firstName = $this->testStringEntry(htmlspecialchars(trim($newCible['first_name'])));
            $stmt->bindParam(':firstName', $firstName);

            $codeName = $this->testStringEntry(htmlspecialchars(trim($newCible['code_name'])));
            $stmt->bindParam(':codeName', $codeName);

        if (in_array(trim($newCible['nationality']), self::$_countrys_nationalitys)) {
            $nationality = $this->testStringEntry(htmlspecialchars($newCible['nationality']));
            $stmt->bindParam(':nationality', $nationality);
        } else {
            return;
          }

            $dateOfBirth = $this->testStringEntry(htmlspecialchars(trim($newCible['date_of_birth'])));
            $stmt->bindParam(':dateOfBirth', $dateOfBirth);

            $stmt->execute();
            return;
    }

    public function deleteCible($id) {    
        $stmt = self::$_instance_db->prepare('DELETE from cibles WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}