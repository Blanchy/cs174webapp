<?php
    if(session_id() == '') {
        session_start();
    }
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>';
   if (!($_SESSION['type'])==0 && !($_SESSION['type'])==1) {
    
    echo 'No user set.<br>';
    echo "You are not authorized to view this page. Please log in again.";
        require_once("logout.php");
        exit;

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Continue to site</title>
<body>
<?php
    if ($_SESSION['type'] == 0) { //admin
        echo <<<END
        <form>
        <input type="button" 
            value="Continue to site" 
            onclick="window.location.href='welcomeadmin.php'" />
        </form>
END;
    }
    else if ($_SESSION['type'] == 1) { //regular user
        echo <<<END
        <form>
        <input type="button" 
            value="Continue to site" 
            onclick="window.location.href='welcomeuser.php'" />
        </form>
END;
    }
    else {
        echo "There was an error during authentication. Please try logging in again.";
        require_once("logout.php");
    }
?>
        
</body>
</html>