<?php 

class Contactmanager extends Dbconnect {

    public function getContacts() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM contacts");
            $stmt->execute();
            $rowContacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rowContacts;
    }

    public function getContactUniq(Contact $newContact) {
        $contact = $newContact->getContact();

        $stmt = self::$_instance_db->prepare("SELECT last_name, first_name, code_name FROM contacts WHERE last_name = :lastName AND first_name = :firstName AND code_name = :codeName");
            $stmt->bindParam(':lastName', $contact['last_name']); 
            $stmt->bindParam(':firstName', $contact['first_name']); 
            $stmt->bindParam(':codeName', $contact['code_name']);
                $stmt->execute();
                $rowContactUniq = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($rowContactUniq) < 1) {
                    var_dump($contact);
                    $this->insertContact($contact); 
                } else {
                    return $rowContactUniq;
                }
    }


    public function getContact_s($contact) {
        $stmt = self::$_instance_db->prepare("SELECT * FROM contacts ON last_name = :lastName AND first_name = :firstName AND code_name = :codeName");
            $stmt->bindParam(':lastName', $contact['last_name']); 
            $stmt->bindParam(':firstName', $contact['first_name']); 
            $stmt->bindParam(':codeName', $contact['code_name']);
                $stmt->execute();
                $contact_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $contact_s;
    }


    public function insertContact($newContact) {
        $stmt = self::$_instance_db->prepare("INSERT INTO contacts (last_name, first_name, code_name, nationality, date_of_birth) VALUES (:lastName, :firstName, :codeName, :nationality, :dateOfBirth)");
            
            $lastName = $this->testStringEntry(htmlspecialchars(trim($newContact['last_name'])));
            $stmt->bindParam(':lastName', $lastName);

            $firstName = $this->testStringEntry(htmlspecialchars(trim($newContact['first_name'])));
            $stmt->bindParam(':firstName', $firstName);

            $codeName = $this->testStringEntry(htmlspecialchars(trim($newContact['code_name'])));
            $stmt->bindParam(':codeName', $codeName);
            
        if (in_array(trim($newContact['nationality']), self::$_countrys_nationalitys)) {
            $nationality = $this->testStringEntry(htmlspecialchars($newContact['nationality']));
            $stmt->bindParam(':nationality', $nationality);
        } else {
            return;
          }

            $dateOfBirth = $this->testStringEntry(htmlspecialchars(trim($newContact['date_of_birth'])));
            $stmt->bindParam(':dateOfBirth', $dateOfBirth);

            $stmt->execute();
            return;
    }

    public function deleteContact($id) {    
        $stmt = self::$_instance_db->prepare('DELETE from contacts WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}