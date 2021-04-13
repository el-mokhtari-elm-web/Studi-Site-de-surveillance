<?php 

class Agentmanager extends Dbconnect {

    private $_specialitys = ["infiltration", "espionnage", "filature", "enquete", "surveillance"];


/*------------------------------------------------------FUNCTIONS FOR GET----------------------------------------------------------*/

    public function getAgents() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM agents");
            $stmt->execute();
            $rowAgents = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rowAgents;
    }

    public function getAgentUniq(Agent $newAgent, $countSpeciality_s) {
        $agent = $newAgent->getAgent();

        $stmt = self::$_instance_db->prepare("SELECT id, last_name, first_name FROM agents WHERE last_name = :lastName AND first_name = :firstName");
        $stmt->bindParam(':lastName', $agent['last_name']); 
        $stmt->bindParam(':firstName', $agent['first_name']); 
            $stmt->execute();
            $rowAgentUniq = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rowAgentUniq) < 1) {
                $this->insertAgent($agent, $countSpeciality_s); 
            } else {
                return $rowAgentUniq;
              }
    }

    public function getSpeciality_s($id) {
        $stmt = self::$_instance_db->prepare("SELECT * FROM agents INNER JOIN agents_active ON agents_active.agent_id = agents.id AND agents.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
    }

/*------------------------------------------------------FUNCTIONS FOR GET----------------------------------------------------------*/    



/*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/

    public function insertAgent($newAgent, $countSpeciality_s) {
        $stmt = self::$_instance_db->prepare("INSERT INTO agents (last_name, first_name, code_id, nationality, date_of_birth, specialitys) VALUES (:lastName, :firstName, :codeId, :nationality, :dateOfBirth, :countSpeciality_s)");
                
            $lastName = trim($newAgent['last_name']);
            $lastName = htmlspecialchars($lastName);
            $lastName = $this->testStringEntry($lastName);
            $stmt->bindParam(':lastName', $lastName); 
                
            $firstName = trim($newAgent['first_name']);
            $firstName = htmlspecialchars($firstName);
            $firstName = $this->testStringEntry($firstName);
            $stmt->bindParam(':firstName', $firstName);

        if ($newAgent['code_id'] > 0) {   
            $codeId = trim($newAgent['code_id']);
        } else {
            return;
        }
            $codeId = htmlspecialchars($newAgent['code_id']);
            $stmt->bindParam(':codeId', $codeId); 

        if  (in_array(trim($newAgent['nationality']), self::$_countrys_nationalitys)) {
            $nationality = htmlspecialchars($newAgent['nationality']);
            $stmt->bindParam(':nationality', $nationality);
        } else {
            return;
          }

            $dateOfBirth = trim($newAgent['date_of_birth']);
            $dateOfBirth = htmlspecialchars($dateOfBirth);
            $dateOfBirth = $this->testStringEntry($dateOfBirth);
            $stmt->bindParam(':dateOfBirth', $dateOfBirth); 

            $stmt->bindParam(':countSpeciality_s', $countSpeciality_s);
            
                    if ($stmt->execute() === true) {
                        $stmt = self::$_instance_db->prepare("SELECT id FROM agents WHERE last_name = :lastName AND first_name = :firstName");
                        $stmt->bindParam(':lastName', $lastName); 
                        $stmt->bindParam(':firstName', $firstName);
                            $stmt->execute();                  
                            $rowAgentUniq = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $speciality_s = $newAgent['speciality_s'];

                            foreach ($speciality_s as $key => $speciality) {
                                if (in_array($speciality, $this->_specialitys)) {
                                    $this->insertSpeciality_s($speciality, $rowAgentUniq[0]["id"]);
                                }
                            }
                            return;
                    } else {
                        return;
                      }
    }


    public function insertSpeciality_s($speciality, $agentId) {
        $stmt = self::$_instance_db->prepare("INSERT INTO agents_active (speciality_type, agent_id) VALUES (:specialityType, :agentId)");
            $stmt->bindParam(':specialityType', $speciality); 
            $stmt->bindParam(':agentId', $agentId);
                $stmt->execute();
    }

    public function insertSpeciality($speciality, $agentId) {
        $i = 0;
        $stmt = self::$_instance_db->prepare("SELECT * FROM agents WHERE id = :agentId");
        $stmt->bindParam(':agentId', $agentId); 
            $stmt->execute();
        
            $rowSpecialitys = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = self::$_instance_db->prepare("SELECT * FROM agents_active WHERE agent_id = :agentId AND speciality_type = :specialityType");
            $stmt->bindParam(':specialityType', $speciality);
            $stmt->bindParam(':agentId', $agentId); 
                $stmt->execute(); $i++;                
                $rowCurrentSpecialitys = $stmt->fetchAll(PDO::FETCH_ASSOC);            

                    if (count($rowCurrentSpecialitys) < 1) {
                        $stmt = self::$_instance_db->prepare("INSERT INTO agents_active (speciality_type, agent_id) VALUES (:specialityType, :agentId)");  
                            $stmt->bindParam(':specialityType', $speciality); 
                            $stmt->bindParam(':agentId', $agentId);

                                if ($stmt->execute() === true) {
                                    $specs = $rowSpecialitys[0]['specialitys']+$i;

                                    $stmt = self::$_instance_db->prepare("UPDATE agents SET specialitys = :specs WHERE id = :agentId");
                                    $stmt->bindParam(':agentId', $agentId); 
                                    $stmt->bindParam(':specs', $specs);
                                    $stmt->execute();
                                    header('Location: ' .ADMIN);
                                    exit;
                                }
                    }

    }

/*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/



/*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/

    public function deleteAgent($id) {    
        $stmt = self::$_instance_db->prepare('DELETE from agents WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    }

    public function deleteSpeciality($agentId, $currentSpecId) {    
        $stmt = self::$_instance_db->prepare("SELECT specialitys FROM agents WHERE id = :agentId");
        $stmt->bindParam(':agentId', $agentId); 
            $stmt->execute();                  
            $rowSpecialitys = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ((count($rowSpecialitys) > 0) && ($rowSpecialitys[0]['specialitys'] > 1)) {
                    $stmt = self::$_instance_db->prepare('DELETE from agents_active WHERE id = :currentSpecId');
                        $stmt->bindParam(':currentSpecId', $currentSpecId);  

                            if ($stmt->execute()) {
                                $specs = $rowSpecialitys[0]['specialitys']-1;

                                $stmt = self::$_instance_db->prepare("UPDATE agents SET specialitys = :specs WHERE id = :agentId");
                                $stmt->bindParam(':agentId', $agentId); 
                                $stmt->bindParam(':specs', $specs);
                                $stmt->execute();
                                header('Location: ' .ADMIN);
                                exit;
                            }
                }
    }

}

/*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/







