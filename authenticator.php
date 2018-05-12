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

    //$conn = new mysqli($hn, $un, $pw, $db);
    //if ($conn->connect_error) print_error();

    // retrieve salts
    // get pw from form
    $un = $_POST["uname"];
    $pw = $_POST["pword"];

    function saltShaker($length) {
        if (is_numeric($length)) {
            $charset = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
            $salt = '';
            for ($i = 0; $i < $length; $i++) {
                $salt .= $charset[rand(0, strlen($charset)-1)];
            }
            return $salt;
        }
    }

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

    function redirect_to_login() {
        echo <<<END
        <h4>Wrong credentials. Please try again.</h4>
        <input type="button" 
                value="Login again" 
                onclick="window.location.href='loginform.php'" />
END;
        exit;
    }

    // sanitize
    if (strlen($un) > 0 && strlen($pw) > 0) {
        $temp_un = sanitize($un);
    }
    else {
        echo "One or more fields were empty";
    }
    
    $sanUn = sanitize($un);
    $sanPw = sanitize($pw);

    require_once("dbproperties.php");
    $conn = new mysqli($host, $un, $pw, $db);
    if ($conn->connect_error) {
        print_error();
        die($conn->connect_error);
    }
    $query = "SELECT * FROM $usertb where username = '$sanUn'";
    $result = $conn->query($query);
    if (!$result) {
        print_error();
        die($conn->error);
    }
    
    if ($result->num_rows < 1) {
        redirect_to_login();
    }

    // there should only be one row
    $result->data_seek(0);
    $id = $result->fetch_assoc()['uID'];
    $result->data_seek(0);
    $username = $result->fetch_assoc()['username'];
    $result->data_seek(0);
    $s1 = $result->fetch_assoc()['salt1'];
    $result->data_seek(0);
    $s2 = $result->fetch_assoc()['salt2'];
    $result->data_seek(0);
    $utype = $result->fetch_assoc()['utype'];
    $result->data_seek(0);
    $hash = $result->fetch_assoc()['hashpw'];
    $result->close();
    echo "id: $id<br>salt 1: $s1<br>salt 2: $s2<br>type: $utype<br>hash: $hash<br>";

    $testPw = hash('ripemd128',$s1.$sanPw.$s2);

    // if session, direct
    // else print login
    echo "$testPw vs $hash";
    if ($testPw == $hash) {
        echo 'creating session for...';
        session_start();
        $_SESSION['un'] = $username;
        $_SESSION['unid'] = $id;
        echo $_SESSION['un']."<br>";
        $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] .
        $_SERVER['HTTP_USER_AGENT']);
    
        echo "You have been logged in. Please click to continue. Do not reload this page.";
        require_once('continue.php');
        exit;
        //header("Location: continue.php");
        //exit;
    }
    else {
        redirect_to_login();
    }
    
?>