<?php
include 'classes.php';
include 'design.php';
navbar("cdlogin");
if (isset($_SESSION["username"])) {
    header("location: cddashboard.php");
}

$dbhandler = new DBHandler;

echo "<br><br>";
echo "<br><br>";
$username = "";
$password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $state = $dbhandler->getUserDetail($username, "cdmarketers");
    if ($state != null) {
        $user = array();
        $pass = array();
        while ($temp = mysqli_fetch_array($state)) {
            $user[] = $temp["username"];
            $pass[] = $temp["password"];
        }

        if (strcmp($pass[0], md5($password)) == 0) {
            echo "<br>Log in Succesful";
            $_SESSION["username"] = $username;
            $_SESSION["table"] = "cdmarketers";
            header("location: cddashboard.php");
            //code that takes the user to dashboard where he/she can update sale details
        } else {
            echo "<div class='alert alert-warning'>
  <strong>Warning!</strong>
  ";

            echo"<ul><li>Username or Password is Incorrect";

            echo "</ul></div>";
        }
        //echo "<br> Wrong password";
    } else { {
            echo "<div class='alert alert-warning'>
  <strong>Warning!</strong>
  ";

            echo"<ul><li>Username or Password is Incorrect";

            echo "</ul></div>";
            // echo "<br> username doesnt exist";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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
                    &nbsp;&nbsp; <a href="cdsignup.php">sign up </a>
                </div>

                <div class="form-group">                


                </div>

                <div class="form-group"> 
                    <input type="checkbox">&nbsp; &nbsp;Remember me
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

