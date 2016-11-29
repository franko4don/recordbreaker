<?php
include 'classes.php';
include 'design.php';
navbar("Registration");
echo '<br><br><br>';


$form_handler = new FormHandler;
$dbhandler = new DBHandler;
$str3 = "Abia,Adamawa,Anambra,AkwaIbom,Bauchi,Bayelsa,Benue,Borno,CrossRiver,Delta,Ebonyi,Enugu,Edo,Ekiti,Gombe,Imo,Jigawa,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara";
$state = explode(",", $str3);

$str2 = "title,surname,firstname,othernames,username,password,gender,state,country,confirmpassword,email,phonenumber,address";

$values = explode(",", $str2);
$names = array();
for ($i = 0; $i < sizeof($values); $i++) {
    $names[$values[$i]] = "";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($names as $name => $value) {
        $names[$name] = test_input($_POST[$name]);
    }
    $errors = $form_handler->formValidation($names,"cdmarketers");

    if (sizeof($errors) == 0) {
        $create = $dbhandler->createTable($names, "cdmarketers"," VARCHAR(200) NOT NULL");
        if ($create) {
            $insert = $dbhandler->insert($names, "cdmarketers");
            if ($insert) {
                //header("Location: message.php");
            }
        }
        //check if the data was succesfully updated to database
    } else {
        echo "<div class='alert alert-warning '>
  <strong>Warning!</strong>
  ";

        echo"<ul>";
        foreach ($errors as $error => $value) {
            echo "<li>" . $value . "</li>";
        }
        echo "</ul></div>";
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
    <div class="row" style="padding-top: 6%;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 style="font-weight: bold; text-align: center; color: background; padding-bottom: 4%">CD MARKETER</h2>
            <?php
            formopen();
            title($names["title"]);
            surname($names["surname"]);
            firstname($names["firstname"]);
            othernames($names["othernames"]);
            username($names["username"]);
            password();
            confirmpassword();
            country();
            state($state);
            email($names["email"]);
            phonenumber($names["phonenumber"]);
            gender();
            address($names["address"]);
            submitbutton("Submit");
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