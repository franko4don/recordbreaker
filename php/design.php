<?php

function navbar($title) {
    session_start();
    $_SESSION["logintype"] = $title;
    echo '<!DOCTYPE.html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
         <script type="text/javascript" src="/recordbreakers/php/first.js"></script>
         

        <title>' . $title .
    ' </title>

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

                    </ul>';
    $errors = array();

    if ($_SESSION["logintype"]=="cdlogin") {
        $errors["one"] = "cdlogin";
    }
    if ($_SESSION["logintype"]=="cdsignup") {
        $errors["two"] = "cdsignup";
    }

    if (sizeof($errors) == 0) {
        if (isset($_SESSION["username"])) {
            welcome();
        } else {
            loginpanel();
        }
    }

    echo '</div>
            </div>
        </nav>
        </div>'
    ;
}

function welcome() {
    echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Hi! ' . $_SESSION["username"] . '</a></li>
                        <li><a href="session.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul> ';
}

function loginpanel() {
    echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="cdsignup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="cdlogin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul> ';
}

function title($title) {
    echo '                <div class="form-group" >
                    <label for="title" >Title<span>*</span></label>
                    <select name="title" class="form-control" value="' . $title . '">
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Engr</option>
                        <option>Dr</option>
                        <option>Miss</option>
                        <option>Pharm</option>
                        <option>Prof</option>
                    </select> 
                </div>';
}

function surname($surname) {

    echo '<div class="form-group">
                    <label for="surname">Surname<span>*</span></label>
                    <input type="text"  name="surname" class="form-control" value="' . $surname . '"  placeholder="Enter Surname">
                </div>';
}

function firstname($firstname) {

    echo '<div class="form-group">
                    <label for="firstname">Firstname<span>*</span></label>
                    <input type="text"  name="firstname" class="form-control" value="' . $firstname . '"  placeholder="Enter First Name">
                </div>';
}

function othernames($othernames) {

    echo '<div class="form-group" >
                    <label for="othernames">Other Names</label>
                    <input type="text"  name="othernames" class="form-control" value="' . $othernames . '"  placeholder="Enter other Names">
                </div>';
}

function username($username) {
    echo '<div class="form-group">
                    <label for="username" >Username<span>*</span></label>
                    <input type="text"  name="username"  class="form-control" value="' . $username . '"  placeholder="Enter Username">
                </div>';
}

function password() {
    echo '<div class="form-group">
                    <label for="password" >Password<span>* (length must be greater than 5)</span></label>
                    <input type="password"  name="password" class="form-control"  placeholder="Enter password">
                </div>';
}

function confirmpassword() {
    echo '<div class="form-group">
                    <label for="confirmpassword" >Confirm Password<span>*</span></label>
                    <input type="password"  name="confirmpassword" class="form-control"  placeholder="Confirm Password">
                </div>';
}

function country() {

    echo '<div class="form-group">
                    <label for="country" >Country</label>
                    <select name="country" class="form-control">
                        <option>Nigeria</option>
                    </select>
                </div>';
}

/**
 * pass an array containing states
 * @param type $state 
 */
function state($state) {
    echo '<div class="form-group">
                    <label for="state" >State<span>*</span></label>
                    <select name="state" class="form-control">';

    for ($i = 0; $i < sizeof($state); $i++) {
        echo "<option>" . $state[$i] . "</option>";
    }

    echo'</select> 
                </div>';
}

function email($email) {
    echo '<div class="form-group">
                    <label for="email">Email<span>*</span></label>
                    <input type="email"  name="email" class="form-control" value="' . $email . '"  placeholder="Enter Email">
                </div>';
}

function phonenumber($phonenumber) {
    echo '<div class="form-group">
                    <label for="number">PhoneNumber<span>*</span></label>
                    <input type="text"  name="phonenumber" class="form-control" value="' . $phonenumber . '"  placeholder="Enter Phone Number">
                </div>';
}

/**
 * pass an array called subjects which contains different subjects
 * @param type $subjects 
 */
function subject($subjects) {

    echo '<div class="form-group">
                    <label for="subject1" >Subject1<span>*</span></label>
                    <select name="subject" class="form-control" value="<?php echo $names["subject"]; ?>">';

    for ($i = 0; $i < sizeof($subjects); $i++) {
        echo "<option>" . $subjects[$i] . "</option>";
    }

    echo ' </select> 
                </div>';
}

function birthdate($birthdate) {

    echo '<div class="form-group">
                    <label for="birthdate" >Date of Birth<span>*</span></label>
                    <input type="date" name="birthdate" class="form-control" value="' . $birthdate . '" placeholder="mm/dd/yyyy">
                </div>';
}

function gender() {
    echo '<div class="form-group">
                    <label for="gender" >Gender:</label>
                    <span><input type="radio" name="gender" value="male" checked></span> Male
                    <span><input type="radio" name="gender" value="female"></span> Female
                </div>';
}

function address($address) {
    echo '<div class="form-group">
                    <label for="Address"  >Address<span>*</span></label>
                    <textarea name="address" class="form-control" rows="3">';
    echo $address;
    echo '</textarea>
                </div>';
}

function description($description) {
    echo '<div class="form-group">
                    <label for="description"  >Description:</label>
                    <textarea name="description" class="form-control" rows="3">';
    echo $description;
    echo' </textarea>
                </div>';
}

function submitbutton($info) {
    echo '<div class="form-group">                
                    <button type="submit"  class="btn btn-primary" >' . $info . '</button>  
                </div>';
}

function formclose() {
    echo '</form>';
}

function formopen() {
    echo ' <form style="color: background;" class="form-horizontal" enctype="multipart/form-data" role="form" action="';
    echo htmlspecialchars($_SERVER["PHP_SELF"]);

    echo '" method="post">';
}

function select($options, $name, $label) {
    echo '<div class="form-group">
                    <label for="' . $label . '" >' . $label . '</label>
                    <select name="' . $name . '" class="form-control">';

    for ($i = 0; $i < sizeof($options); $i++) {
        echo "<option>" . $options[$i] . "</option>";
    }

    echo'</select> 
                </div>';
}

function number($number, $label, $name) {
    echo '<div class="form-group">
                    <label for="number">' . $label . '<span>*</span></label>
                    <input type="number"  name="' . $name . '" class="form-control" value="' . $number . '"  placeholder="Enter ' . $label . '">
                </div>';
}

function showProfile($array) {
    echo '<table class="table table-hover" style="border: 2px solid background;">';
    foreach ($array as $key => $value) {
        if($key=="id"||$key=="password"||$key=="date"||$key=="time"){
            continue;
        }
        echo '      <tr style="font-weight: bold;color: background">
        <td>'.strtoupper($key).'</td>
        <td>'.$value.'</td>
      </tr>';
    }
     echo ' </table>';
}

?>
