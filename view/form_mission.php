<h1 class="title-mission">Affréter une Mission</h1>

<form id="form-mission" method="post">

    <fieldset class="fieldset-mission">

           <ul>
                <li class="row">
                    <label class="input-mission">Titre de la mission<input class="input-mission" id="title-mission" type="text" name="title_mission"></label>
                </li>

                <li class="row">
                    <label for="country-mission">Pays
                        <select class="input-mission" id="country-mission" name="country">

                            <?php
                                foreach ($countrys as $keyCountry => $value) :
                            ?>

                                <option class="input-mission" value="<?php echo $keyCountry; ?>"><?php echo $keyCountry; ?></option>

                            <?php 
                                endforeach; 
                            ?>

                        </select>
                    </label>
                </li>

                <li class="row">
                    <label class="input-mission">Date begin<input class="input-mission" id="date_begin" type="date" name="date_begin"></label>
                </li>

                <li class="row">
                    <label class="input-mission">Date finish<input class="input-mission" id="date_finish" type="date" name="date_finish"></label>
                </li>

                <li class="row">                
                    <label class="input-mission">Agents<input class="input-mission" id="agents" type="number" min="1" max="10" name="agent_s_mission"></label>
                </li>

                <li class="row">                
                    <label class="input-mission">Contacts<input class="input-mission" id="contacts" type="number" min="1" max="10" name="contact_s_mission"></label>
                </li>

                <li class="row">                
                    <label class="input-mission">Cibles<input class="input-mission" id="cibles" type="number" min="1" max="10" name="cible_s_mission"></label>
                </li>

                <li class="row">                
                    <label class="input-mission">Planques<input class="input-mission" id="planque_s" type="number" min="0" max="10" name="planque_s_mission"></label>
                </li>

                <li class="row">
                    <label for="type-mission">Type de la mission
                        <select class="input-mission" id="type-mission" name="type_mission">

                            <?php
                            $rowTypesMissions = ["Export", "Import", "Rapide", "Longue"];
                                foreach ($rowTypesMissions as $key => $rowTypeMission) :
                            ?>

                                <option class="input-mission" value="<?php echo $rowTypeMission; ?>"><?php echo $rowTypeMission; ?></option>

                            <?php 
                                endforeach; 
                            ?>

                        </select>
                    </label>
                </li>

                <li class="row">
                    <label for="speciality-mission">Spécialité de la mission
                        <select class="input-mission" id="speciality-mission" name="speciality_mission">

                            <?php
                                foreach ($rowSpecialityTypes as $specialityType) :
                            ?>

                                <option class="input-mission" value="<?php echo $specialityType["speciality_type"]; ?>"><?php echo $specialityType["speciality_type"]; ?></option>

                            <?php 
                                endforeach; 
                            ?>

                        </select>
                    </label>
                </li>

                <li class="row">                
                    <label class="input-mission">Nom de code<input class="input-mission" id="code_name" type="text" name="code_name"></label>
                </li>

                <li class="text-area">
                    <label for="message">Descriptif de la Mission</label>
                    <textarea id="text-mission" rows="7" cols="30" name="objectif_mission"></textarea>
                </li>
                    
                <input class="submit-mission" name="submit_mission" type="submit" value="Assigner">
            </ul>

    </fieldset>

</form>


