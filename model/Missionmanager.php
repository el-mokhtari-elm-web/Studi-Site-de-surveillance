<?php 

class Missionmanager extends Dbconnect {

    private $_specialitys = ["infiltration", "espionnage", "filature", "enquete", "surveillance"];
    private $_typesMissions = ["Export", "Import", "Rapide", "Longue"];


/*-------------------------------------------------------------FUNCTIONS GET----------------------------------------------------------------------------------------*/    

    public function getMissions() {
        $stmt = self::$_instance_db->prepare("SELECT * FROM missions");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
    }

    public function getAgentsMissions($missionId) { 
        $stmt = self::$_instance_db->prepare("SELECT * FROM agents_active INNER JOIN missions ON missions.id = agents_active.mission_id INNER JOIN agents ON agents.id = agents_active.agent_id WHERE missions.id = :missionId");
        $stmt->bindParam(':missionId', $missionId);    
        $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
    }

    public function getContactsMissions($missionId) { 
        $stmt = self::$_instance_db->prepare("SELECT DISTINCT missions.contact_s, CO.first_name, CO.last_name FROM agents_active INNER JOIN missions ON missions.id = agents_active.mission_id INNER JOIN contacts AS CO ON missions.id = CO.mission_id WHERE missions.id = :missionId");
        $stmt->bindParam(':missionId', $missionId);    
        $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
    }

    public function getCiblesMissions($missionId) { 
        $stmt = self::$_instance_db->prepare("SELECT DISTINCT missions.cible_s, CI.first_name, CI.last_name FROM agents_active INNER JOIN missions ON missions.id = agents_active.mission_id INNER JOIN cibles AS CI ON missions.id = CI.mission_id WHERE missions.id = :missionId");
        $stmt->bindParam(':missionId', $missionId);    
        $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
    }

    public function getPlanquesMissions($missionId) { 
        $stmt = self::$_instance_db->prepare("SELECT DISTINCT missions.planque_s, PL.code, PL.location_name FROM agents_active INNER JOIN missions ON missions.id = agents_active.mission_id INNER JOIN planques AS PL ON missions.id = PL.mission_id WHERE missions.id = :missionId");
        $stmt->bindParam(':missionId', $missionId);    
        $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
    }

/*-------------------------------------------------------------FUNCTIONS GET----------------------------------------------------------------------------------------*/    




/*--------------------------FUNCTION PROCESS CONTROLLER BY GET FOR INSERT AND UPDATE (mission_id and count_actors) of missions-------------------------------------*/    

    public function getMissionUniq(Mission $newMission, $agents, $contacts, $cibles, $planques, $specialityType) { 
        $mission = $newMission->getMission();
        $country = $mission['country'];

        $stmt = self::$_instance_db->prepare("SELECT * FROM missions WHERE title_mission = :titleMission AND code_name = :codeName");
        $stmt->bindParam(':titleMission', $mission['title_mission']); 
        $stmt->bindParam(':codeName', $mission['code_name']); 
            $stmt->execute();
            $rowMissionUniq = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            if (count($rowMissionUniq) < 1) {
                $this->insertMission($mission, $agents, $contacts, $cibles, $planques);
            } else {
                return $rowMissionUniq;
              }

                $stmtAgents = self::$_instance_db->prepare("SELECT * FROM agents_active WHERE agents_active.speciality_type = :specialityType AND agents_active.mission_id IS NULL ORDER BY agents_active.mission_id DESC"); 
                $stmtAgents->bindParam(':specialityType', $specialityType);
                    $stmtAgents->execute();
                    $this->deleteMissionNotComplete($stmtAgents->rowCount()); // if NOT agents delete mission because not possible mission without agent

                $stmtContacts = self::$_instance_db->prepare("SELECT * FROM contacts WHERE nationality = :nationality AND mission_id IS NULL ORDER BY mission_id DESC"); 
                $stmtContacts->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
                    $stmtContacts->execute();
                    $this->deleteMissionNotComplete($stmtContacts->rowCount()); // if NOT contact delete mission because not possible mission without contact

                $stmtCibles = self::$_instance_db->prepare("SELECT * FROM cibles WHERE nationality <> :nationality AND mission_id IS NULL ORDER BY mission_id DESC"); 
                $stmtCibles->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
                    $stmtCibles->execute();
                    $this->deleteMissionNotComplete($stmtCibles->rowCount());  // if NOT cible delete mission because not possible mission without cible

                $stmtPlanques = self::$_instance_db->prepare("SELECT * FROM planques WHERE country = :country AND mission_id IS NULL ORDER BY mission_id DESC"); 
                $stmtPlanques->bindParam(':country', $country);
                    $stmtPlanques->execute(); // the mission without planque is possible


                if (($stmtAgents->rowCount() < 1) || ($stmtContacts->rowCount() < 1) || ($stmtCibles->rowCount() < 1) || ($stmtPlanques->rowCount() < 1)) {
                    header('Location: ' .ADMIN);
                    exit;
                }

                    if ($agents > $stmtAgents->rowCount()) {
                        $agents = $stmtAgents->rowCount(); 
                    } 

                    if ($contacts > $stmtContacts->rowCount()) {
                        $contacts = $stmtContacts->rowCount(); 
                    } 

                    if ($cibles > $stmtCibles->rowCount()) {
                        $cibles = $stmtCibles->rowCount(); 
                    }

                    if ($planques > $stmtPlanques->rowCount()) {
                        $planques = $stmtPlanques->rowCount(); 
                    }

                    $stmtAgents = self::$_instance_db->prepare("SELECT * FROM agents_active LEFT JOIN missions ON agents_active.speciality_type = missions.speciality_type AND missions.speciality_type = :specialityType WHERE agents_active.mission_id IS NULL ORDER BY missions.id DESC LIMIT $agents");   
                        $stmtAgents->bindParam(':specialityType', $specialityType);
                            $stmtAgents->execute();
                            $datasAgentsActive = $stmtAgents->fetchAll(PDO::FETCH_ASSOC); 

                        foreach ($datasAgentsActive as $key => $datasAgentActive) {
                            $this->updateMissionIdAgent($datasAgentActive['agent_id'], $datasAgentActive['id'], $datasAgentActive['speciality_type']);
                            $missionId = $datasAgentActive['id'];
                        }

                        $stmtUpdate = self::$_instance_db->prepare("UPDATE missions SET agent_s = :agents ORDER BY id DESC LIMIT 1");
                            $stmtUpdate->bindParam(':agents', $agents);
                                $stmtUpdate->execute();



                    $stmtContacts = self::$_instance_db->prepare("SELECT * FROM contacts INNER JOIN missions ON missions.country = :country AND contacts.nationality = :nationality WHERE contacts.mission_id IS NULL ORDER BY mission_id DESC LIMIT $contacts");   
                        $stmtContacts->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
                        $stmtContacts->bindParam(':country', $country);
                            $stmtContacts->execute();
                                $datasContactsActive = $stmtContacts->fetchAll(PDO::FETCH_ASSOC); 

                        foreach ($datasContactsActive as $key => $datasContactActive) {
                            $this->updateMissionIdContact($missionId, $mission['country'], $contacts);
                        }

                        $stmtUpdate = self::$_instance_db->prepare("UPDATE missions SET contact_s = :contacts ORDER BY id DESC LIMIT 1");
                            $stmtUpdate->bindParam(':contacts', $contacts);
                                $stmtUpdate->execute();



                    $stmtCibles = self::$_instance_db->prepare("SELECT * FROM cibles WHERE nationality <> :nationality AND mission_id IS NULL ORDER BY mission_id DESC LIMIT $cibles");   
                        $stmtCibles->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
                            $stmtCibles->execute();
                                $datasCiblesActive = $stmtCibles->fetchAll(PDO::FETCH_ASSOC); 

                        foreach ($datasCiblesActive as $key => $datasCibleActive) {
                            $this->updateMissionIdCible($missionId, $mission['country'], $cibles);
                        }

                        $stmtUpdate = self::$_instance_db->prepare("UPDATE missions SET cible_s = :cibles ORDER BY id DESC LIMIT 1");
                            $stmtUpdate->bindParam(':cibles', $cibles);
                                $stmtUpdate->execute();   

                        if ($planques > 0) {        

                        $stmtPlanques = self::$_instance_db->prepare("SELECT * FROM planques WHERE country = :country AND mission_id IS NULL ORDER BY mission_id DESC LIMIT $planques");   
                            $stmtPlanques->bindParam(':country', $country);
                                $stmtPlanques->execute();
                                    $datasPlanquesActive = $stmtPlanques->fetchAll(PDO::FETCH_ASSOC); 

                            foreach ($datasPlanquesActive as $key => $datasPlanqueActive) {
                                    $this->updateMissionIdPlanque($missionId, $mission['country'], $planques);
                            }

                        }

                        $stmtUpdate = self::$_instance_db->prepare("UPDATE missions SET planque_s = :planques ORDER BY id DESC LIMIT 1");
                            $stmtUpdate->bindParam(':planques', $planques);
                                $stmtUpdate->execute();                                
                                
                                
                            $stmt->closeCursor();
                            $stmtContacts->closeCursor();
                            $stmtCibles->closeCursor();
                            $stmtPlanques->closeCursor();
                            $stmtUpdate->closeCursor();

                return;
    }

/*--------------------------FUNCTION PROCESS CONTROLLER BY GET FOR INSERT AND UPDATE (mission_id and count_actors) of missions-------------------------------------*/



/*------------------------------------------------------FUNCTIONS UPDATE MISSION_ID-----------------------------------------------------------------*/

    public function updateMissionIdAgent($agentId, $missionId, $specialityMission) { 
        $stmt = self::$_instance_db->prepare("UPDATE agents_active SET mission_id = :missionId WHERE agent_id = :agentId AND speciality_type = :specialityType");
        $stmt->bindParam(':agentId', $agentId); 
        $stmt->bindParam(':missionId', $missionId);
        $stmt->bindParam(':specialityType', $specialityMission);
            $stmt->execute();
    }

    public function updateMissionIdContact($missionId, $country, $contacts) { 
        $stmt = self::$_instance_db->prepare("UPDATE contacts SET mission_id = :missionId WHERE nationality = :nationality AND mission_id IS NULL LIMIT $contacts");
        $stmt->bindParam(':missionId', $missionId); 
        $stmt->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
            $stmt->execute();
    }

    public function updateMissionIdCible($missionId, $country, $cibles) { 
        $stmt = self::$_instance_db->prepare("UPDATE cibles SET mission_id = :missionId WHERE nationality != :nationality AND mission_id IS NULL LIMIT $cibles");
        $stmt->bindParam(':missionId', $missionId); 
        $stmt->bindParam(':nationality', self::$_countrys_nationalitys[$country]);
            $stmt->execute();
    }

    public function updateMissionIdPlanque($missionId, $country, $planques) { 
        $stmt = self::$_instance_db->prepare("UPDATE planques SET mission_id = :missionId WHERE country = :country AND mission_id IS NULL LIMIT $planques");
        $stmt->bindParam(':missionId', $missionId); 
        $stmt->bindParam(':country', $country);
            $stmt->execute();
    }

/*------------------------------------------------------FUNCTIONS UPDATE MISSION_ID-----------------------------------------------------------------*/



/*------------------------------------------------------------FUNCTIONS INSERT----------------------------------------------------------------------*/

    public function insertMission($newMission, $agents, $contacts, $cibles, $planques) {
        $stmt = self::$_instance_db->prepare("INSERT INTO missions (title_mission, objectif_mission, code_name, country, agent_s, contact_s, cible_s, mission_type, statut, planque_s, speciality_type, date_begin, date_finish) VALUES (:titleMission, :objectifMission, :codeName, :country, :agent_s, :contact_s, :contact_s, :typeMission, :statut, :planque_s, :specialityMission, :dateBegin, :dateFinish)");
                
            $title = trim($newMission['title_mission']);
            $title = htmlspecialchars($title);
            $title = $this->testStringEntry($title);
            $stmt->bindParam(':titleMission', $title); 
                
            $objectifMission = trim($newMission['objectif_mission']);
            $objectifMission = htmlspecialchars($objectifMission);
            $objectifMission = $this->testTextEntry($objectifMission);
            $stmt->bindParam(':objectifMission', $objectifMission);

            $codeName = trim($newMission['code_name']);
            $codeName = htmlspecialchars($codeName);
            $codeName = $this->testStringEntry($codeName);
            $stmt->bindParam(':codeName', $codeName);

        if  (array_key_exists(trim($newMission['country']), self::$_countrys_nationalitys)) {
            $country = trim($newMission['country']);
            $country = htmlspecialchars($newMission['country']);
            $country = $this->testStringEntry($newMission['country']);
            $stmt->bindParam(':country', $country);
        } else {
            return;
          }

        if  ((intval($newMission['agent_s_mission']) > 0) && (intval($newMission['agent_s_mission']) < 1000)) {
            $agent_s = trim($agents);
            $agent_s = htmlspecialchars($agent_s);
            $agent_s = $this->testStringEntry($agent_s);
            $stmt->bindParam(':agent_s', $agent_s);
        } else {
            return;
        }

        if  ((intval($newMission['contact_s_mission']) > 0) && (intval($newMission['contact_s_mission']) < 1000)) {
            $contact_s = trim($contacts);
            $contact_s = htmlspecialchars($contact_s);
            $contact_s = $this->testStringEntry($contact_s);
            $stmt->bindParam(':contact_s', $contact_s);
        } else {
            return;
        }

        if  ((intval($newMission['cible_s_mission']) > 0) && (intval($newMission['cible_s_mission']) < 1000)) {
            $cible_s = trim($cibles);
            $cible_s = htmlspecialchars($cible_s);
            $cible_s = $this->testStringEntry($cible_s);
            $stmt->bindParam(':contact_s', $cible_s);
        } else {
            return;
        }

        if  (in_array(trim($newMission['type_mission']), $this->_typesMissions)) {
            $typeMission = htmlspecialchars($newMission['type_mission']);
            $typeMission = $this->testStringEntry($typeMission);
            $stmt->bindParam(':typeMission', $typeMission);
        } else {
            return;
        }

            $statut = "En préparation";
            $stmt->bindParam(':statut', $statut); 

        if  ((intval($newMission['planque_s_mission']) >= 0) && (intval($newMission['planque_s_mission']) < 1000)) {
            $planque_s = trim($planques);
            $planque_s = htmlspecialchars($planque_s);
            $planque_s = intval($planque_s);
            $stmt->bindParam(':planque_s', $planque_s);
        } else {
            return;
        }

        if  (in_array($newMission['speciality_mission'], $this->_specialitys)) {
            $specialityMission = htmlspecialchars(trim($newMission['speciality_mission']));
            $specialityMission = $this->testStringEntry($specialityMission);
            $stmt->bindParam(':specialityMission', $specialityMission);
        } else {
            return;
        }

            $dateBegin = trim($newMission['date_begin']);
            $dateBegin = htmlspecialchars($dateBegin);
            $dateBegin = $this->testStringEntry($dateBegin);
            $stmt->bindParam(':dateBegin', $dateBegin);

            $dateFinish = trim($newMission['date_finish']);
            $dateFinish = htmlspecialchars($dateFinish);
            $dateFinish = $this->testStringEntry($dateFinish);
            $stmt->bindParam(':dateFinish', $dateFinish);

            if ($stmt->execute()) {
                return;
            } else {
                return;
            }
    }

/*------------------------------------------------------------FUNCTIONS INSERT----------------------------------------------------------------------*/



/*------------------------------------------------------------FUNCTIONS DELETE----------------------------------------------------------------------*/

    public function deleteMission($id) {    
        $stmt = self::$_instance_db->prepare('DELETE from missions WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    }

    public function deleteMissionNotComplete($countRow) {
        if ($countRow < 1) {
            $mission = self::$_instance_db->prepare("SELECT id FROM missions ORDER BY id DESC LIMIT 1"); 
            $mission->execute();
            $row = $mission->fetchAll(PDO::FETCH_ASSOC);
            $this->deleteMission($row[0]['id']);
            header('Location: ' .ADMIN);
            exit;
        }
    }

/*------------------------------------------------------------FUNCTIONS DELETE----------------------------------------------------------------------*/



}