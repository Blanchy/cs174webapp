<?php
    if (isset($_SESSION['un'])) {
        echo 'Current user: '.$_SESSION['un'].'<br>There is already a user set. 
        To prevent additional issues, diconnecting now... try logging in again';
        require_once('logout.php');
        exit;
    }
    else {
        echo 'First time running authenticator';
    }

    $hn = 'localhost';
    $un = 'blanchy';
    $pw = '';
    $db = 'MalwareAnalysis';
    $tb = 'user';
    //$conn = new mysqli($hn, $un, $pw, $db);
    //if ($conn->connect_error) print_error();

    // retrieve salts
    // get pw from form
    $un = $_POST["uname"];
    $pw = $_POST["pword"];

    
    function sanitize($s) {
        if (get_magic_quotes_gpc()) $s = stripslashes($s);
        $s = strip_tags($s);
        return htmlentities($s);
    }

    //this hashes the input pw
    function create_pw($s1, $s2, $pw) {
        $s1 = (saltShaker(4));
        $s2 = (saltShaker(4));
        return hash('ripemd128',$s1.$pw.$s2);
    }

    function print_error() {
       return "ERROR OCCURED: ".mysql_error();
    }

    // sanitize
    if (strlen($un) > 0 && strlen($pw) > 0) {
        $temp_un = sanitize($un);
    }
    else {
        echo "One or more fields were empty";
    }
    

    //$conn->close();
    // if session, direct
    // else print login
    if (1) {
        echo 'creating session for...';
        session_start();
        $_SESSION['un'] = $un;
        echo $_SESSION['un']."<br>";
        $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] .
        $_SERVER['HTTP_USER_AGENT']);
    
        echo "You have been logged in. Please click to continue. Do not reload this page.";
        require_once('continue.php');
        exit;
        //header("Location: continue.php");
        //exit;
    }
    
?>