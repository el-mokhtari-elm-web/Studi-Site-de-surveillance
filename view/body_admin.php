<?php
require_once("../config/config.php");

$dbName = new PDO(DSN , DB_USER, DB_PASS);

require_once("../model/Dbconnect.php"); 

require_once("../model/Nationalitys.php");
$nationalitys = new Nationalitys($dbName);
$rowNationalitys = $nationalitys->getNationalitys();
$countrys = $nationalitys->getCountrysAndNationalitys();

require_once("../model/SpecialityTypes.php");
$specialityTypes = new SpecialityTypes($dbName);
$rowSpecialityTypes = $specialityTypes->getSpecialityTypes();

require_once("../model/Agentmanager.php");
$agents = new Agentmanager($dbName);
$rowAgents = $agents->getAgents();

require_once("../model/Contactmanager.php");
$contacts = new Contactmanager($dbName);
$rowContacts = $contacts->getContacts();

require_once("../model/Ciblemanager.php");
$cibles = new Ciblemanager($dbName);
$rowCibles = $cibles->getCibles();

require_once("../model/Planquemanager.php");
$planques = new Planquemanager($dbName);
$rowPlanques = $planques->getPlanques();

require_once("../model/Missionmanager.php");
$missions = new Missionmanager($dbName);
$rowMissions = $missions->getMissions();

if (isset($_POST["submit_mission"])) {
    require_once("../model/Mission.php");
    require_once("../model/Missionmanager.php");
    $newMission = new Mission($_POST);
    $mission = new Missionmanager($dbName);

    $countAgent_s = intval($_POST["agent_s_mission"]);
    $countContact_s = intval($_POST["contact_s_mission"]);
    $countCible_s = intval($_POST["cible_s_mission"]);
    $countPlanque_s = intval($_POST["planque_s_mission"]);
    $specialityMission = $_POST["speciality_mission"];


  $mission->getMissionUniq($newMission, $countAgent_s, $countContact_s, $countCible_s, $countPlanque_s, $specialityMission);

  header('Location: ' .ADMIN);
  exit;

}

if (isset($_GET['link'])) {
    switch ($_GET['link']) {
        case "agent":
            $agents->deleteAgent($_GET['id']);
            break;   
        case "contact":
            $contacts->deleteContact($_GET['id']);
            break;
        case "cible":
            $cibles->deleteCible($_GET['id']);
            break;
        case "planque":
            $planques->deletePlanque($_GET['id']);
            break;    
        case "mission":
            $missions->deleteMission($_GET['id']);
            break;            

        default:
        return;
    }
    header('Location: ' .ADMIN);
    exit;
} 

if (isset($_GET['agent-id'])) {
    $agentId = intval($_GET['agent-id']);
    $specId = intval($_GET['spec-id']);
    $agents->deleteSpeciality($agentId, $specId);
}
?>


<!-------------------------------------------------------form-pretendant-missions----------------------------------------------------------->

<div id="container" class="container-fluid">

<h3>Interface d'administration</h3>

    <section id="form-manag" class="form-manag">   

        <h4 id="title-forms-data">Formulaires des inscriptions</h4>

            <form id="form-agent" method="post" name="form-agent" action="../controller/process_datas.php">
                <fieldset>
                    <legend>Agent</legend>
                        <aside id="infos-agent">
                            <label class="input">Last Name<input type="text" name="last_name"></label>
                            <label class="input">First Name<input type="text" name="first_name"></label>
                            <label class="input">Code Id<input type="number" min="0" name="code_id"></label>

                            <label class="input">Nationality
                                <select name="nationality">

                                    <?php
                                        foreach ($rowNationalitys as $nationality) :
                                    ?>

                                        <option value="<?php echo $nationality["nationality_name"]; ?>"><?php echo $nationality["nationality_name"]; ?></option>

                                    <?php 
                                        endforeach; 
                                    ?>

                                </select>
                            </label>

                            <label class="input">Date of Birtd<input type="date" name="date_of_birth"></label>
                        </aside>

                        <aside id="specialitys">
                            <?php
                                foreach ($rowSpecialityTypes as $speciality) :
                            ?>

                                <input type="checkbox" name="speciality_s[]" value="<?php echo $speciality["speciality_type"]; ?>"><label class="checkbox"><?php echo $speciality["speciality_type"]; ?></label>

                            <?php
                                endforeach;
                            ?>
                            <sup>Choisir au moins une spécialité obligatoire !</sup>
                        </aside>

                        <aside>
                            <label class="submit"><input name="submit_agent" type="submit" value="Enregistrer"></label>
                        </aside>
                </fieldset>
            </form> 

            <form id="form-contact" method="post" name="form-contact" action="../controller/process_datas.php">
                <fieldset>
                    <legend>Contact</legend>
                        <aside id="infos-contact">
                            <label class="input">Last Name<input type="text" name="last_name"></label>
                            <label class="input">First Name<input type="text" name="first_name"></label>
                            <label class="input">Code Name<input type="text" name="code_name"></label>

                            <label class="input">Nationality
                                <select name="nationality">

                                    <?php
                                        foreach ($rowNationalitys as $nationality) :
                                    ?>

                                        <option value="<?php echo $nationality["nationality_name"]; ?>"><?php echo $nationality["nationality_name"]; ?></option>

                                    <?php 
                                        endforeach; 
                                    ?>

                                </select>
                            </label>

                            <label class="input">Date of Birtd<input type="date" name="date_of_birth"></label>
                        </aside>

                        <aside>
                            <label class="submit"><input name="submit_contact" type="submit" value="Enregistrer"></label>
                        </aside>
                </fieldset>
            </form> 

            <form id="form-cible" method="post" name="form-cible" action="../controller/process_datas.php">
                <fieldset>
                    <legend>Cible</legend>
                        <aside id="infos-cible">
                            <label class="input">Last Name<input type="text" name="last_name"></label>
                            <label class="input">First Name<input type="text" name="first_name"></label>
                            <label class="input">Code Name<input type="text" name="code_name"></label>

                            <label class="input">Nationality
                                <select name="nationality">

                                    <?php
                                        foreach ($rowNationalitys as $nationality) :
                                    ?>

                                        <option value="<?php echo $nationality["nationality_name"]; ?>"><?php echo $nationality["nationality_name"]; ?></option>

                                    <?php 
                                        endforeach; 
                                    ?>

                                </select>
                            </label>

                            <label class="input">Date of Birtd<input type="date" name="date_of_birth"></label>
                        </aside>

                        <aside>
                            <label class="submit"><input name="submit_cible" type="submit" value="Enregistrer"></label>
                        </aside>
                </fieldset>
            </form>

            <form id="form-planque" method="post" name="form-planque" action="../controller/process_datas.php">
                <fieldset>
                    <legend>Planque</legend>
                        <aside id="infos-planque">
                            <label class="input">Code<input type="text" name="code"></label>
                            <label class="input">Adresse<input type="text" name="location_name"></label>

                            <label class="input">Country
                                <select name="countrys">

                                <?php
                                    foreach ($countrys as $key => $country) :
                                ?>

                                    <option value="<?php echo $key; ?>"><?php echo $key; ?></option>

                                <?php
                                    endforeach;
                                ?>

                                </select>
                            </label>

                            <label class="input">Type
                                <select name="specialitys_type">

                                <?php
                                $rowTypesPlanques = ["Appartement", "Maison", "Entrepot", "Bar", "Boomker"];
                                    foreach ($rowTypesPlanques as $key => $rowTypePlanque) :
                                ?>

                                    <option value="<?php echo $rowTypePlanque; ?>"><?php echo $rowTypePlanque; ?></option>

                                <?php
                                    endforeach;
                                ?>

                                </select>
                            </label>

                        </aside>

                        <aside>
                            <label class="submit"><input name="submit_planque" type="submit" value="Enregistrer"></label>
                        </aside>
                </fieldset>
            </form>

    </section>

    <section id="table-manag">
        <table>
            <caption>Mettre à jour les données Agent</caption>
                <thead>
                    <tr><th id="entete" colspan="8">Agents</th></tr>
                    <tr><th>Id</th><th>Last Name</th><th>First Name</th><th>Code Id</th><th>Nationality</th><th>Birth</th><th>Specialitys</th><th></th></tr>
                </thead>

                <tbody>
                        <?php
                            foreach ($rowAgents as $agent) :
                        ?>

                        <tr>
                            <td><?php echo $agent['id']; ?></td>
                            <td><?php echo $agent['last_name']; ?></td>
                            <td><?php echo $agent['first_name']; ?></td>
                            <td><?php echo $agent['code_id']; ?></td>
                            <td><?php echo $agent['nationality']; ?></td>
                            <td><?php echo $agent['date_of_birth']; ?></td>
                            <td><?php echo $agent['specialitys']; ?></td>
                            <td><a href="?link=agent&id=<?php echo $agent['id']; ?>" class="delete" id="delete" name="delete"><img src="<?php echo IMG. 'delete.png'; ?>"></a></td>
                        </tr>

                        <?php

                        ?>

                        <tr>

                            <td COLSPAN="2">
                                    <select id="spec-agent" name="specialitys_type">
                                        <option value="">Specialitys</option>

                                        <?php
                                            $specialitysAgent = $agents->getSpeciality_s(intval($agent['id'])); 
                                                foreach ($specialitysAgent as $currentSpec) : 
                                                    if ($agent['id'] === $currentSpec['agent_id']) :
                                        ?>

                                            <option value="<?php echo $currentSpec['speciality_type']; ?>"><?php echo $currentSpec['speciality_type']; ?></option>
                                    
                                        <?php
                                                    endif; 
                                                endforeach;
                                        ?>
                                    
                                    </select>
                            </td>
   
                            <th COLSPAN="7">
                                <form method="post" class="update-form" action="../controller/process_datas.php">

                                        <?php
                                        $specialitysGet = "";
                                            foreach ($rowSpecialityTypes as $speciality) : 
                                        ?>

                                            <input class="update-input" type="checkbox" name="speciality_s[<?php echo $agent['id']; ?>][]" value="<?php echo $speciality["speciality_type"]; ?>">
                                            <label class="checkbox"><?php echo $speciality["speciality_type"]; ?><input class="update-input" name="update" type="submit" value="+"></label>

                                        <?php
                                            endforeach;
                                        ?>
                            
                            </th>

                                    
                                </form>
                        </tr>

                        <tr>
                            <td COLSPAN="9">
                                <ul id="current-spec">
                                <li>Types de missions possibles :</li>
                                    <?php                  
                                        foreach ($specialitysAgent as $currentSpec) : 
                                    ?>

                                        <li><?php echo $currentSpec["speciality_type"]; ?><a href="?agent-id=<?php echo $currentSpec["agent_id"].'&spec-id='.$currentSpec["id"]; ?>">X</a></li>

                                    <?php
                                        endforeach;
                                    ?>
                                </ul>
                            </td>                    
                        </tr>

                        <?php
                            endforeach; 
                        ?>
                </tbody>
        </table>

        <table>
            <caption>Mettre à jour les données Contact</caption>
                <thead>
                    <tr><th id="entete" colspan="7">Contacts</th></tr>
                    <tr><th>Id</th><th>Last Name</th><th>First Name</th><th>Code Name</th><th>Nationality</th><th>Birth</th><th>Supprimer</th></tr>
                </thead>

                <tbody>
                        <?php
                            foreach ($rowContacts as $contact) :
                        ?>

                        <tr>
                            <td><?php echo $contact['id']; ?></td>
                            <td><?php echo $contact['last_name']; ?></td>
                            <td><?php echo $contact['first_name']; ?></td>
                            <td><?php echo $contact['code_name']; ?></td>
                            <td><?php echo $contact['nationality']; ?></td>
                            <td><?php echo $contact['date_of_birth']; ?></td>
                            <td><a href="?link=contact&id=<?php echo $contact['id']; ?>" class="delete" id="delete" name="delete"><img src="<?php echo IMG. 'delete.png'; ?>"></a></td>
                        </tr>

                        <?php
                            endforeach;
                        ?>
                </tbody>
        </table>

        <table>
            <caption>Mettre à jour les données Cibles</caption>
                <thead>
                    <tr><th id="entete" colspan="7">Cibles</th></tr>
                    <tr><th>Id</th><th>Last Name</th><th>First Name</th><th>Code Name</th><th>Nationality</th><th>Birth</th><th>Supprimer</th></tr>
                </thead>

                <tbody>
                        <?php
                            foreach ($rowCibles as $cible) :
                        ?>

                        <tr>
                            <td><?php echo $cible['id']; ?></td>
                            <td><?php echo $cible['last_name']; ?></td>
                            <td><?php echo $cible['first_name']; ?></td>
                            <td><?php echo $cible['code_name']; ?></td>
                            <td><?php echo $cible['nationality']; ?></td>
                            <td><?php echo $cible['date_of_birth']; ?></td>
                            <td><a href="?link=cible&id=<?php echo $cible['id']; ?>" class="delete" id="delete" name="delete"><img src="<?php echo IMG. 'delete.png'; ?>"></a></td>
                        </tr>

                        <?php
                            endforeach;
                        ?>
                </tbody>
        </table>

        <table>
            <caption>Mettre à jour les données Planque</caption>
                <thead>
                    <tr><th id="entete" colspan="6">Planques</th></tr>
                    <tr><th>Id</th><th>Code</th><th>Adresse</th><th>Country</th><th>Type</th><th>Supprimer</th></tr>
                </thead>

                <tbody>
                        <?php
                            foreach ($rowPlanques as $planque) :
                        ?>

                        <tr>
                            <td><?php echo $planque['id']; ?></td>
                            <td><?php echo $planque['code']; ?></td>
                            <td><?php echo $planque['location_name']; ?></td>
                            <td><?php echo $planque['country']; ?></td>
                            <td><?php echo $planque['speciality_type']; ?></td>
                            <td><a href="?link=planque&id=<?php echo $planque['id']; ?>" class="delete" id="delete" name="delete"><img src="<?php echo IMG. 'delete.png'; ?>"></a></td>
                        </tr>

                        <?php
                            endforeach;
                        ?>
                </tbody>
        </table>

<!-------------------------------------------------------form-pretendant-missios----------------------------------------------------------->



<!------------------------------------------------------------form-Missions---------------------------------------------------------------->

        <?php
            require_once("form_mission.php");
        ?>

    </section>

<!------------------------------------------------------------form-Missions---------------------------------------------------------------->



<!------------------------------------------------------------Manag-Missions--------------------------------------------------------------->

    <section class="form-manag">

        <table id="table_missions">
            <caption>Missisons</caption>
                <thead>
                    <tr><th id="entete" colspan="14">Infos sur les missions</th></tr>
                    <tr><th>Id</th><th>title</th><th>Code</th><th>Pays</th><th>Agents</th><th>Contacts</th><th>Cibles</th><th>Type</th><th>Statut</th><th>Planques</th><th>Spécialité</th><th>Démarage</th><th>Fin</th><th>Supprimer</th></tr>
                </thead>

                <tbody>
                    <?php
                        foreach ($rowMissions as $mission) :
                    ?>

                        <tr>
                            <td><?php echo $mission['id']; ?></td>
                            <td><?php echo $mission['title_mission']; ?></td>
                            <td><?php echo $mission['code_name']; ?></td>
                            <td><?php echo $mission['country']; ?></td>
                            <td><?php echo $mission['agent_s']; ?></td>
                            <td><?php echo $mission['contact_s']; ?></td>
                            <td><?php echo $mission['cible_s']; ?></td>
                            <td><?php echo $mission['mission_type']; ?></td>
                            <td><?php echo $mission['statut']; ?></td>
                            <td><?php echo $mission['planque_s']; ?></td>
                            <td><?php echo $mission['speciality_type']; ?></td>
                            <td><?php echo $mission['date_begin']; ?></td>
                            <td><?php echo $mission['date_finish']; ?></td>
                            <td><a href="?link=mission&id=<?php echo $mission['id']; ?>" class="delete" id="delete" name="delete"><img src="<?php echo IMG. 'delete.png'; ?>"></a></td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <select class="input-data-mission" name="nationality">
                                    <option class="input-data-mission">Agents</option>

                                        <?php
                                        $datasAgents = $missions->getAgentsMissions($mission['id']);
                                            foreach ($datasAgents as $key => $datasAgent) :
                                        ?>

                                            <option class="input-data-mission" value="<?php echo $datasAgent["id"]; ?>"><?php echo $datasAgent["first_name"]; ?></option>

                                        <?php 
                                            endforeach; 
                                        ?>
                                </select>
                            </td>

                            <td colspan="4">
                                <select class="input-data-mission" name="nationality">
                                    <option class="input-data-mission">Contacts</option>

                                        <?php                     
                                        $datasContacts = $missions->getContactsMissions($mission['id']);                      
                                            foreach ($datasContacts as $key => $datasContact) :
                                        ?>

                                            <option class="input-data-mission" value="<?php echo $datasContact["id"]; ?>"><?php echo $datasContact["first_name"]; ?></option>

                                        <?php 
                                            endforeach; 
                                        ?>
                                </select>
                            </td>

                            <td colspan="3">
                                <select class="input-data-mission" name="nationality">
                                    <option class="input-data-mission">Cibles</option>

                                        <?php                     
                                        $datasCibles = $missions->getCiblesMissions($mission['id']);                      
                                            foreach ($datasCibles as $key => $datasCible) :
                                        ?>

                                            <option class="input-data-mission" value="<?php echo $datasCible["id"]; ?>"><?php echo $datasCible["first_name"]; ?></option>

                                        <?php 
                                            endforeach; 
                                        ?>
                                </select>
                            </td>

                            <td colspan="3">
                                <select class="input-data-mission" name="nationality">
                                    <option class="input-data-mission">Planques</option>

                                        <?php                     
                                        $datasPlanques = $missions->getPlanquesMissions($mission['id']);                      
                                            foreach ($datasPlanques as $key => $datasPlanque) :
                                        ?>

                                            <option class="input-data-mission" value="<?php echo $datasPlanque["code"]; ?>"><?php echo $datasPlanque["location_name"]; ?></option>

                                        <?php 
                                            endforeach; 
                                        ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td id="objectif_mission" class="text-mission" colspan="14"><p><?php echo $mission["objectif_mission"]; ?></p></td>
                        </tr>

                    <?php
                        endforeach; 
                    ?>
                </tbody>
        </table>

    </section>

</div>


<!------------------------------------------------------------Manag-Missions--------------------------------------------------------------->
