<?php
if (!isset($_SESSION["uniqId"])) {
$_SESSION["uniqId"] = uniqid();
} 
$_SESSION["sessionId"] = session_id();
?>

<header class="d-flex justify-content-center">
        <div id="bloc-logo">
            <a href="<?php echo '../index.php'; ?>" class="logo" title="elm-monitor.com">
                <img src="<?php echo IMG. 'logo_elmmonitor.png'; ?>" class="logo" alt="elm-monitor">
            </a>
        </div>

        <h1 class="titre">Agence de surveillance</h1>

        <nav class="nav-admin">
            <ul class="menu-admin">
                <li>
                    <form action="../controller/process_logout.php" method="post">
                        <input name="hidden" type="hidden" id="hidden" class="hidden">
                        <input name="logout" type="submit" class="logout" value="Log Out">
                    </form>
                </li>
            </ul>

        </nav>
</header>

