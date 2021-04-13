<header class="d-flex justify-content-center">
        <div id="bloc-logo">
            <a href="<?php echo ACCUEIL; ?>" class="logo" title="elm-monitor.com">
                <img src="<?php echo IMG. 'logo_elmmonitor.png'; ?>" class="logo" alt="elm-monitor">
            </a>
        </div>

        <h1 class="titre">Agence de surveillance</h1>

        <nav class="nav">

            <?php
                if ((isset($_SESSION["uniqId"]) && ($_SESSION["sessionId"] === session_id()))) :
            ?>
            
                <ul id="menu-admin" class="menu-admin">
                    <li><a href="<?php echo ADMIN; ?>" class="admin" title="admin">Admin</a></li>
                    <li>
                        <form class="form-admin" action="controller/process_logout.php" method="post">
                            <input name="hidden" type="hidden" id="hidden" class="hidden">
                            <input name="logout" type="submit" class="logout" value="Log Out">
                        </form>
                    </li>
                </ul>

            <?php
                else :
            ?>

                <ul id="menu" class="menu">
                    <li><p class="link">Espace Admin</p></li>
                    <li>
                        <section id="login">
                            <form action="<?php echo ADMIN; ?>" method="post">
                                <label for="email">Email 
                                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com"></label>
            
                                <label for="password" class="form-label">Password
                                <input name="password"  type="password" class="form-control" id="password"></label>
                            
                                <input name="submit" type="submit" class="form-control" id="submit">
                            </form>
                        </section>
                    </li>

                    <?php
                        if ((isset($_GET["message"])) && ($_GET["message"] === "empty")) :
                    ?>

                        <li id="message"><span style="font-size:1.25vw; color:tomato;">Le formulaire est vide</span></li>

                    <?php
                        elseif ((isset($_GET["message"])) && ($_GET["message"] === "incomplete")) :
                    ?>

                        <li id="message"><span style="font-size:1.25vw; color:tomato;">Les deux champs doivent<br>avoir entre 7 et 33<br>caractères</span></li>

                        <?php
                        endif;
                        ?>

                </ul>

                <?php
                    endif;
                ?>

        </nav>
</header>