<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (isset($_SESSION['un'])) {
    echo 'Current user: '.$_SESSION['un'].'<br>On the creation page?';
    require_once("disconnect.php");
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Creating an account</title>
    </head>
<body>

<?php

    
    $newUn = $_POST["nuname"];
    $nuPw = $_POST["npword"];
    $nuPw2 = $_POST["npword2"];
    $email = $_POST["emaddr"];

    echo 'usr = '.$newUn.'<br>pw1 = '.$nuPw.'<br>pw2 = '.$nuPw2.'<br>';

    function sanitize($s) {
        if (get_magic_quotes_gpc()) $s = stripslashes($s);
        $s = strip_tags($s);
        return htmlentities($s);
    }

    function is_alphanumeric($str) {    
        if (!preg_match('/[^A-Za-z0-9]/', $str)) // '/[^a-z\d]/i' should also work.
        {
            echo "string contains only english letters & digits<br>";
            return true;
        }
        else return false;
    }

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

    function create_pw($s1, $s2, $pw) {
        return hash('ripemd128',$s1.$pw.$s2);
    }

    function print_error() {
        return "ERROR OCCURED: ".mysql_error();
     }

    if (strlen($newUn) < 3 || strlen($nuPw) < 6 || strlen($nuPw2) < 6 || strlen($newUn) > 10) {
        echo 'Could not create account. <br>
        Usernames must be alphanumeric with a length of 3-10 characters. <br>
        Passwords must be at least 6 characters long.';
        exit;
    }
    if (is_alphanumeric($newUn)) {
        echo 'Username is valid.<br>';
        $newUn = sanitize($newUn);
    }
    else {
        echo 'Invalid username.<br>';
        exit;
    }

    if ($nuPw === $nuPw2) {
        echo 'Passwords match.<br>';
        $nuPw = sanitize($nuPw);
    }
    else {
        echo 'Passwords do not match.<br>';
        exit;
    }

    $s1 = (saltShaker(4));
    $s2 = (saltShaker(4));
    $hashpw = create_pw($s1, $s2, $nuPw);
    $utype = 1;

    echo 's1 = '.$s1.'<br>s2 = '.$s2.'<br>hash = '.$hashpw;
    
    require_once("dbproperties.php");
    $conn = new mysqli($host, $un, $pw, $db);
    if ($conn->connect_error) {
        print_error();
        die($conn->connect_error);
    }
    else echo 'Connected to database... creating account';
    
    $query = "SELECT * FROM $usertb where username = '$newUn'";
    $result = $conn->query($query);
    if (!$result) {
        echo "error executing query";
        die($conn->error);
    }
    if ($result->num_rows > 0) {
        $result->close();
        echo "This username is taken.";
        exit;
    }

    echo "password hash: $hashpw";
    $stmt = $conn->prepare('INSERT INTO '.$usertb.' VALUES(NULL,?,?,?,?,?,?)');
    $stmt->bind_param('ssssss',$email, $newUn, $hashpw, $s1, $s2, $utype);
    $stmt->execute();

    printf("%d Row inserted.\n", $stmt->affected_rows);

    $stmt->close();
    $conn->close();
    $result->close();
    
?>
    <div>
        <p>Successfully registered. You may now log in.</p>
        <p>
            <form>
            <input type="button" 
            value="Return to login page" 
            onclick="window.location.href='loginform.php'" />
            </form>
        </p>
    </div>
</body>
</html>
