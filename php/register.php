<?php
include 'design.php';
include 'classes.php';
navbar("Registration");
$str="investor,marketer";
$usertype=  explode(",", $str);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type=$_POST["user"];
    echo $type;
    header( "Location:/recordbreakers/php/".$type.".php");
    
}
?>

<div class="container">
    <div class="row" style="padding-top: 10%;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            formopen();
            select($usertype,"user","Register As");
            submitbutton();
            ?>
            

        </div>
        <div class="col-sm-3"></div>
    </div>
</div>