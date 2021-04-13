<?php
session_start();

require_once("../config/config.php");

require_once("../view/heading.php");

if ((isset($_SESSION["sessionId"])) && ($_SESSION["sessionId"] === session_id())) {

    require_once("../view/header_admin.php");

} else {

    require_once("../view/header.php");

  }
?>

<div id="container" class="container-fluid">
    <section id="contact_form" class="row col-12">
        <h2 class="form"></h2>
            <article class="col-12">
                <h3>Contactez nous</h3> 
                <p>Page de contact</p>
            </article> 
    </section>
</div>

<?php
require_once("../view/footer.php");
?>