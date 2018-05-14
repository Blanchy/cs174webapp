<?php
session_start();
//echo session_id();
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>';
   if (!($_SESSION['type'])==0 || !($_SESSION['type'])==1) {
        
    echo 'No user set.<br>';
    echo "You are not authorized to view this page. Please log in again.";
        require_once("logout.php");
        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Upload File for Analysis</title>
    </head>
<body>
    <div>
    <form action="fileresults.php"
        method="post"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Analyze a file</legend>
            <p>
                <label>Upload file: </label><br>
                <input type="file" name="infile" id="infile">
            </p>
            <p>
                <input type="submit">
            </p>
        </fieldset>
    </form>
    </div>
    <div>
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
    </div>
</body>
</html>