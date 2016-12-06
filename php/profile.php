<?php
include 'classes.php';
include 'design.php';
navbar("Profile");
if(!isset($_SESSION["username"])){
    header("location: cdlogin.php");
}
$dbhandler=new DBHandler;
?>
<div class="container-fluid">
    <div class="row" style="padding-top: 6%;">

        <div class="col-sm-2"></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6" >
        <h3 style="font-weight: bold; text-align: center; color: background; padding-bottom: 1%;  ">
            <?php
            echo $_SESSION["username"]."'s profile";
            ?>
        </h3>

                
                    <?php

                    $column=array();
                    $query=$dbhandler->selectAll("cdmarketers");
                    while ($temp = mysqli_fetch_array($query)) {
                        foreach($temp as $key=>$value){
                           
                            if(!is_integer($key)){
                            $column[$key]=$value;
                            }
                        }
               
               
            }
            showProfile($column);
 ?>
           
        </div>

        <div class="col-sm-3"></div>
    </div>
</div>