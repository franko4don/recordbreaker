<?php
include 'design.php';
navbar("Dash Board");
$username=$_SESSION["username"];
if(!isset($username)){
    header("location: cdlogin.php");
}
?>
   <!DOCTYPE.html>
<!--<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/recordbreakers/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/recordbreakers/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link href="/recordbreakers/css/navlinks.css" rel="stylesheet"/>
        <script src="/recordbreakers/bootstrap/js/bootstrap.min.js"></script>
        <script src="/recordbreakers/bootstrap/js/bootstrap.js"></script>
         <script src="/recordbreakers/bootstrap/js/jquery.min.js"></script>
         <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

        <title>
          CD dashboard
       </title>

    </head>
    <body>
       <nav class="navbar navbar-inverse navbar-fixed-top"  style="background-color: skyblue; border: none">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">RECORD BREAKERS</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar" >
                    <ul class="nav navbar-nav" id="bar">

                        <li ><a href="#" >Home</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">About</a></li> 
                        <li><a href="#">Contact</a></li>


                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>-->
        
        <div class="container-fluid">
    <div class="row" style="padding-top: 10%;">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="row" style="padding-top: 10%;">
               <div class="col-sm-4">
                <a href="/recordbreakers/php/cdsaleupdate.php" ><span class="glyphicon glyphicon-upload" style="font-size: 900%; ">
                        <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">Update Sales</p> 
                    </span>                   
                 
                </a> 
                  
                
                    
               
               </div>
               <div class="col-sm-4">
                  
               </div>
               <div class="col-sm-4">
                  <a href="#"> <i class="fa fa-line-chart" style="font-size: 900%">
                          <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">View Sales</p> 
                      </i></a>  
                 
               </div>
            </div>

                        <div class="row" style="padding-top: 30%;">
               <div class="col-sm-4">
                <a href="profile.php"><span class="glyphicon glyphicon-user" style="font-size: 900%">
                                                  <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">Profile</p> 
                    </span></a> 
                
               </div>
               <div class="col-sm-4">
                  
               </div>
               <div class="col-sm-4">
                  <a href="#"> <i class="fa fa-gear" style="font-size: 900%">
                                                    <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">Settings</p> 
                      </i></a>   
                  
               </div>
            </div>
            
            <?php
            if($username=="franko4don"){
            echo '          <div class="row" style="padding-top: 30%;">
               <div class="col-sm-4">
                <a href="remove.php"><i class="fa fa-remove" style="font-size: 900%; color: red">
                          <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">Remove user</p>                 
</i></a> 
                
               </div>
               <div class="col-sm-4">
                  
               </div>
               <div class="col-sm-4">
                  <a href="cdassign.php"> <i class="fa fa-mail-forward" style="font-size: 900%">
                          <p></p>
                        <p style="font-weight: bold; font-family: sans-serif; text-align: center; font-size: 15px; color: black;">Assign</p>                   
</i></a>   
                   
               </div>
            </div>';
            }
            ?>
            
        </div>
        <div class="col-sm-4">
            
        </div>
        </div>
            </div>
    </body>
</html>


