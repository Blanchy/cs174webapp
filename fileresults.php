<?php
session_start();
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
        <title>File Results</title>
    </head>
<body>

<?php
require_once('malwareanalysis');
?>

</body>
</html>