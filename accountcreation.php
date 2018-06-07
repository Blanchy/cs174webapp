<?php
/**
 * 
 * Blanchy Polangcos
 * 
 * Account creation.
 * 
 */
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

    /**
     * sanitize string
     */
    function sanitize($s) {
        if (!is_string($s)) {
            die("Error: need a string");
        }
        if (get_magic_quotes_gpc()) $s = stripslashes($s);
        $s = strip_tags($s);
        return htmlentities($s);
    }

    /**
     * generate salts
     */
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

    /**
     * hash password
     */
    function create_pw($s1, $s2, $pw) {
        return hash('ripemd128',$s1.$pw.$s2);
    }

    function print_error() {
        return "ERROR OCCURED: ".mysql_error();
     }

    /**
     * validate syntax
     */
    require_once("loginsyntax.php");
    if (!valSignup($newUn, $nuPw, $nuPw2, $email)) {
        echo "Error creating account. Try signing up again.<br>";
        exit;
    }
    else {
        $nuPw = sanitize($nuPw);
        $newUn = sanitize($newUn);
    }

    $s1 = (saltShaker(4));
    $s2 = (saltShaker(4));
    $hashpw = create_pw($s1, $s2, $nuPw);
    $utype = 1;
    
    require_once("dbproperties.php");
    $conn = new mysqli($host, $un, $pw, $db);
    if ($conn->connect_error) {
        print_error();
        die($conn->connect_error);
    }
    
    /**
     * check if username exists
     */
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

    $stmt = $conn->prepare('INSERT INTO '.$usertb.' VALUES(NULL,?,?,?,?,?,?)');
    $stmt->bind_param('ssssss',$email, $newUn, $hashpw, $s1, $s2, $utype);
    $stmt->execute();
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
