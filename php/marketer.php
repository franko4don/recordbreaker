<?php
include 'classes.php';
include 'design.php';
navbar("Registration");
$form_handler = new FormHandler;
$image_handler = new ImageHandler;
$str3 = "Abia,Adamawa,Anambra,AkwaIbom,Bauchi,Bayelsa,Benue,Borno,CrossRiver,Delta,Ebonyi,Enugu,Edo,Ekiti,Gombe,Imo,Jigawa,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara";
$state = explode(",", $str3);

$str2 = "gender,state,country,title,surname,firstname,othernames,username,password,confirmpassword,email,phonenumber,birthdate,address,description";

$values = explode(",", $str2);
$names = array();
for ($i = 0; $i < sizeof($values); $i++) {
    $names[$values[$i]] = "";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($names as $name => $value) {
        $names[$name] = test_input($_POST[$name]);
    }
    $errors = $form_handler->formValidation($names);
    $path = "/wamp/www/recordbreakers/images/";
    $image_name = "img3.jpg"; //gotten by querying the database for the last entry plus 1

    if (sizeof($errors) == 0 && $image_handler->imageCheck($image_name, $path)) {
        if ($image_handler->uploadImage('file', $path, 400, $image_name)) {
            $names['image'] = $image_name;
            $form_handler->formStore($names, "sub");
        }
        //check if the data was succesfully updated to database
    } else {
        echo "<div class='alert alert-warning '>
  <strong>Warning!</strong> Fill in every required information
  ";
        $errors["image error"] = "image not uploaded";
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
            <h2 style="font-weight: bold; text-align: center; color: background; padding-bottom: 4%">MARKETER</h2>
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
            birthdate($names["birthdate"]);
            gender();
            address($names["address"]);
            description($names["description"]);
            ?>
            <div class="form-group">
                <label for="image"  >Image:</label>
                <input type="file" name="file" id="file" accept="image/gif,image/jpeg,image/png" onchange="loadFile(event)">
            </div>
            <div class="form-group">
                <img id="output"/>
            </div>
            <script>
                //loads seelcted image to the browser
                var loadFile=function(event){
                    var output=document.getElementById('output');
                    output.src=URL.createObjectURL(event.target.files[0]);
                       
                };
            </script>
            <br>
            <?php
            submitbutton();
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