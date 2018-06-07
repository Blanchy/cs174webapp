<?php
/**
 * 
 * Blanchy Polangcos
 * 
 * Upload file to be analyzed. Invokes malwareanalysis
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
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Upload File for Analysis</title>
    </head>
<body>

<?php

if ($_FILES && $_FILES['infile']['type']) {
    echo "Recieved file.  <br>  ";

    //// INVALID FILE
    if ($_FILES['infile']['type'] != 'text/plain') {
        echo 'Invalid file. Txt accepted only.<br>';
    }

    //// VALID FILE
    else {
        $f = $_FILES['infile']['tmp_name'];
        $fh = fopen($f,'r') or die("Could not open file.");
        //echo 'Valid file. <br>';
            if (flock($fh, LOCK_EX)) {
                require_once("malwareanalysis.php"); 
                $matches = isMalware($fh);
                flock($fh,LOCK_UN);
            }  
        fclose($fh);
        };
        if (count($matches) > 0) {
            $str =  "<p>The following malwares were found: 
                    <ul>";
                foreach ($matches as $name) {
                    $str .= "<li>$name</li>";
                }
            $str .= "</ul></p>";
            echo $str;
        }
        else {
            echo <<<END
                <p>No matches found in the database for this file.</p>
END;
        }
    }
//// NO FILE RECIEVED
else {
    echo "Upload a file to begin analysis.<br>";
}

?>


    <div>
    <form action="uploadfile.php"
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
            value="Return home" 
            onclick="window.location.href='welcomeadmin.php'" />
        </form>
END;
    }
    else if ($_SESSION['type'] == 1) { //regular user
        echo <<<END
        <form>
        <input type="button" 
            value="Return home" 
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