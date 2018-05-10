<?php
if(session_id() == '') {
    session_start();
}
//echo session_id();
require_once("disconnect.php");
echo "You have been logged out.<br>";
require_once("loginform.php");

?>