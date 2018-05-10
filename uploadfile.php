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
        <p>
        <form>
        <input type="button" 
            value="Return to main page" 
            onclick="window.location.href='welcomeuser.php'" />
        </form>
        </p>
    </div>
</body>
</html>