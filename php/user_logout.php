<?php
if(session_start()===PHP_SESSION_NONE){
    session_start();
}

session_unset();

session_destroy();

header("Location: ../index.php");
exit;
?>