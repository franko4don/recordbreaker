<?php
include 'classes.php';
include 'design.php';
navbar();
echo "<br><br>";
echo "<br><br>";

?>

<div class="container">
    <div class="row" style="padding-top: 5%;">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form style="color: background;" class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">

                <div class="form-group">
                    <label for="username" >Username</label>
                    <input type="text"  name="username"  class="form-control"  placeholder="Enter Username">
                </div>

                <div class="form-group">
                    <label for="password" >Password</label>
                    <input type="password"  name="password" class="form-control"  placeholder="Enter password">
                </div>
                
                <div class="form-group">                
                    <button type="submit"  class="btn btn-primary" >Login</button>
                    &nbsp;&nbsp;<input type="checkbox">&nbsp; &nbsp;Remember me
                </div> 
                
                 <div class="form-group">                
                    
                    <a href="#">forgot password?</a>
                </div> 
                
        </div>
        <div class="col-sm-4"></div>
    </div>

</div>
</body>
<?php
echo "</html>";
?>