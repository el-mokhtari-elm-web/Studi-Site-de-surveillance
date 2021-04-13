<div id="container" class="container-fluid">
        <section id="sous-titre" class="col-12">
            <h2 class="sous-titre">Bienvenue sur <strong>ELM-monitor</strong><span class="slogan">l'<strong>agence de surveillance</strong> à votre service</span></h2>
        </section>

        <section id="section-infos"  class="d-flex justify-content-center col-6">
            <h3>Voici les informations consultables</h3> 

                <article class="col-12">
                    <h4>Cahier des missions mise à jour</h4> 
                    
                        <form id="select" name="details-mission" method="POST" action="<?php echo PAGE; ?>">
                            <select name="mission-id" class="form-select form-select-lg mb-3 col-12">
                                <option value="<?php echo NULL; ?>" selected>Choisir missions en cours</option>

                                <?php
                                    foreach ($rowMissions as $mission) :
                                ?>

                                    <option value="<?php echo $mission['id']; ?>"><?php echo $mission['title_mission']; ?></option>

                                <?php
                                    endforeach;
                                ?>

                            </select>
                            <input class="details-mission" type="submit" name="details-mission" value="Voir détails">
                        </form>
                </article> 
        </section>
</div>
