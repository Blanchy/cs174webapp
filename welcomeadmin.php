<?php

/**
 * 
 * Blanchy Polangcos
 * 
 * Welcome page for admin.
 * 
 */
if(session_id() == '') {
    session_start();
}

if ($_SESSION['check'] != hash('ripemd128', $_SERVER['REMOTE_ADDR'] .
    $_SERVER['HTTP_USER_AGENT'])) {
        echo "Your current location does not match the one given for this session. Try logging in again.";
        require_once("logout.php");
        exit;
    }

//echo session_id();
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>';
   if (!($_SESSION['type'])==0) {
        if (($_SESSION['type'])==1) {
            require_once("welcomeuser.php");
            exit;
        }
        else {
            echo "You are not authorized to view this page. Please log in again.";
            require_once("logout.php");
            exit;
        }
   }
}
else {
    echo 'No user set.<br>';
    echo "You are not authorized to view this page. Please log in again.";
        require_once("logout.php");
        exit;
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Admin view</title>
    </head>
<body>
    <div><h1>Welcome Admin</h1></div>
    <div>
        <form>
           <input type="button" 
            value="Upload Malware" 
            onclick="window.location.href='uploadmalware.php'" />
            <input type="button" 
            value="Scan for Malware" 
            onclick="window.location.href='uploadfile.php'" />
            <input type="button" 
            value="Logout" 
            onclick="window.location.href='logout.php'" />
        </form>
    </div>
</body>
</html>
