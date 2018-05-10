<?php
//echo session_id();
if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>On the login page?';
    require_once("logout.php");
}
else {
    echo 'No user set.<br>';
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Log in or register</title>
    </head>
<body>
    <h1>Malware Analysis</h1>
    <h3>You are not logged in. Log in or register below.</h3>
    <form action="authenticator.php"
        method="post"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Login to an Existing Account</legend>
            <p>
                <label>Username: </label><br>
                <input type="text" name="uname" id="uname">
            </p>
            <p>
                <label>Password: </label><br>
                <input type="password" name="pword" id="pword">
            </p>
            <p>
                <input type="submit">
            </p>
        </fieldset>
    </form>

    <form action="accountcreation.php"
        method="post"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Create a New Account</legend>
            <p>Usernames must be alphanumeric.</p>
            <p>
                <label>Username: </label><br>
                <input type="text" name="nuname" id="nuname">
            </p>
            <p>
                <label>Email: </label><br>
                <input type="emailAddress" name="emaddr" id="emaddr">
            </p>
            <p>
                <label>Password: </label><br>
                <input type="password" name="npword" id="npword">
            </p>
            <p>
                <label>Retype Password: </label><br>
                <input type="password" name="npword2" id="npword2">
            </p>
            <p>
                <input type="submit">
            </p>
        </fieldset>
    </form>
</body>
</html>