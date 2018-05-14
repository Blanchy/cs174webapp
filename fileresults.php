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
        <title>File Results</title>
    </head>
<body>

<?php
require_once('malwareanalysis');
?>

</body>
</html>