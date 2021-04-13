<?php
session_start();

require_once("../config/config.php");

require_once("../view/heading.php");

$dbName = new PDO(DSN , DB_USER, DB_PASS);
require_once("../model/Dbconnect.php"); 

require_once("../model/Missionmanager.php");
$missions = new Missionmanager($dbName);

if ((isset($_POST['mission-id']) && ($_POST['mission-id']) != null)) {
    $datasAgents = $missions->getAgentsMissions($_POST['mission-id']);
    $datasContacts = $missions->getContactsMissions($_POST['mission-id']);
    $datasCibles = $missions->getCiblesMissions($_POST['mission-id']);
    $datasPlanques = $missions->getPlanquesMissions($_POST['mission-id']); 

    if (isset($_SESSION["sessionId"])) {

        require_once("../view/header_admin.php");

    } else {

        require_once("../view/header.php");

    }

} else {
    header('Location: ' .ACCUEIL);
    exit;
}
?>

<div id="container-mission" class="container-fluid container-mission">

    <section class="infos-mission" class="col-6">
        <h2 class="title-infos"><?php echo $datasAgents[0]["title_mission"]; ?></h2>
            <article class="article-mission">
                <p class="objectif"><?php echo $datasAgents[0]["objectif_mission"]; ?></p>
            </article> 

            <article class="article-mission">
                <h3 class="page">Infos sur l'agent</h3>
                    <ul>
                        <li>Nombre d'agents : <?php echo $datasAgents[0]["agent_s"]; ?></li> 
                            <li>Noms et Prenoms des ou de l'agent :</li> 
                                <?php
                                    foreach ($datasAgents as $key => $datasAgent) :
                                ?>

                                    <li class="agent"><?php echo $datasAgent["first_name"]. ' - ' .$datasAgent["last_name"]; ?></li>

                                <?php
                                    endforeach;
                                ?>
                        <li>Nationalité : <?php echo $datasAgents[0]["nationality"]; ?></li>
                        <li>Date de naissance : <?php echo $datasAgents[0]["date_of_birth"]; ?></li>
                        <li>Nombre de spécialité : <?php echo $datasAgents[0]["specialitys"]; ?></li>
                    </ul>
            </article>
    </section>

    <section class="infos-mission" class="col-6">
        <h2 class="title-infos"><?php echo $datasAgents[0]["statut"]; ?></h2>
            <article class="article-mission">
                <h3 class="page">Infos générales</h3>
                    <ul>
                        <li>Type : <?php echo $datasAgents[0]["mission_type"]; ?></li>
                        <li>Spécialité requisitionné : <?php echo $datasAgents[0]["speciality_type"]; ?></li>
                        <li>Pays : <?php echo $datasAgents[0]["country"]; ?></li> 
                        <li>Date de début : <?php echo $datasAgents[0]["date_begin"]; ?></li>
                        <li>Date de fin : <?php echo $datasAgents[0]["date_finish"]; ?></li>
                    </ul>
            </article>

            <article class="article-mission">
                <h3 class="page">Infos supplémentaire</h3>
                    <ul>
                        <li>Nombre de Contacts : <?php echo $datasContacts[0]["contact_s"]; ?></li>
                            <li>Noms et Prenoms des ou du contact :</li> 
                                <?php
                                    foreach ($datasContacts as $key => $datasContact) :
                                ?>

                                    <li class="agent"><?php echo $datasContact["first_name"]. ' - ' .$datasContact["last_name"]; ?></li>

                                <?php
                                    endforeach;
                                ?>
                        <li>Nombre de Cibles : <?php echo $datasCibles[0]["cible_s"]; ?></li>
                            <li>Noms et Prenoms des ou de la cibles :</li> 
                                <?php
                                    foreach ($datasCibles as $key => $datasCible) :
                                ?>

                                    <li class="agent"><?php echo $datasCible["first_name"]. ' - ' .$datasCible["last_name"]; ?></li>

                                <?php
                                    endforeach;
                                ?>
                        <li>Nombre de Planques : <?php if (count($datasPlanques) < 1) {echo "0";} else {echo $datasPlanques[0]["planque_s"];} ?></li> 
                        <li>Noms et Prenoms des ou de la planques :</li> 
                                <?php
                                if (count($datasPlanques) > 0) :
                                    foreach ($datasPlanques as $key => $datasPlanque) :
                                ?>

                                    <li class="agent"><?php echo $datasPlanque["code"]. ' - ' .$datasPlanque["location_name"]; ?></li>

                                <?php
                                    endforeach;
                                endif;
                                ?>                        
                    </ul>
            </article>
    </section>

</div>

<?php
require_once("../view/footer.php");
?>