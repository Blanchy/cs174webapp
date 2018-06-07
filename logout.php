<?php
if(session_id() == '') {
    session_start();
}
require_once("disconnect.php");
echo "You have been logged out.<br>";
require_once("loginform.php");

?>