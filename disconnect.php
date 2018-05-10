<?php
    if(session_id() == '') {
        session_start();
    }
    
    function disconnect_session() {
        session_unset(); 
        $_SESSION = array();
        setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }

    disconnect_session();
?>