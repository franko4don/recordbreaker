<?php
session_start() or die();
echo "<br><br> this is the session name ".session_id();
session_destroy();
header("location: cdlogin.php");
?>
