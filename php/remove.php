<?php

include 'design.php';
include 'classes.php';
$dbhandler = new DBHandler;
navbar("Remove");
$username = $_SESSION["username"];
if (!isset($username) || $username!="franko4don") {
    header("location: cddashboard.php");
}
$query = $dbhandler->selectAll("cdmarketers");
$surname = array();
$firstname = array();
$user = array();
$names = array();
if ($query != null) {
    while ($temp = mysqli_fetch_array($query)) {
        $surname[] = $temp["surname"];
        $firstname[] = $temp["firstname"];
        $user[] = $temp["username"];
    }

    for ($i = 0; $i < sizeof($user); $i++) {
        $names[$i] = ($user[$i] . " (" . $surname[$i] . " " . $firstname[$i] . ")");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_detail=$_POST["username"];
    $arr=  explode(" (", $user_detail);
    echo "<br><br><br><br>";
    echo $dbhandler->deleteUser("cdmarketers", $arr[0]);
    

}


?>
<div class="container">
    <div class="row" style="padding-top: 6%;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 style="font-weight: bold; text-align: center; color: background; padding-bottom: 4%">DELETE USER</h2>
<?php
formopen();
select($names, "username", "users");
submitbutton("Delete");
formclose();
?>
        </div>
        <div class="col-sm-3"></div>
    </div>

</div>
</body>
<?php
echo "</html>";
?>