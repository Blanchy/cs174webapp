<?php
session_start();
//echo session_id();
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>';
   if (!($_SESSION['type'])==1) {
        if (($_SESSION['type'])==0) {
            require_once("welcomeadmin.php");
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
        <title>User view</title>
    </head>
<body>
        <div><h1>Welcome User</h1></div>
        <div>
            <form>
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
