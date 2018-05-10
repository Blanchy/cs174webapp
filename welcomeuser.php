<?php
if(session_id() == '') {
    session_start();
}
//echo session_id();
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>';
}
else {
    echo 'No user set.<br>';
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
