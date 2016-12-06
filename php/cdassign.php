<?php
include 'design.php';
include 'classes.php';
navbar("Assign");
$username = $_SESSION["username"];
if (!isset($username) || strcmp($username, "franko4don") != 0) {
    header("location: cddashboard.php");
}
$dbhandler = new DBHandler;
$str1 = "Microsoft Word 2007,Microsoft Word 2010,Microsoft Word 2013,Microsoft Word 2016,Microsoft Excel 2007,Microsoft Excel 2007,Microsoft Excel 2010,Microsoft Excel 2013,Microsoft Excel 2016,Microsoft PowerPoint 2007,Microsoft PowerPoint 2010,Microsoft PowerPoint 2013,Microsoft PowerPoint 2016,Internet,Corel Draw X5,Operating System,Photoshop";
$str2 = "MicrosoftWord2007,MicrosoftWord2010,MicrosoftWord2013,MicrosoftWord2016,MicrosoftExcel2007,MicrosoftExcel2007,MicrosoftExcel2010,MicrosoftExcel2013,MicrosoftExcel2016,MicrosoftPowerPoint2007,MicrosoftPowerPoint2010,MicrosoftPowerPoint2013,MicrosoftPowerPoint2016,Internet,CorelDrawX5,OperatingSystem,Photoshop";
$products = explode(",", $str2);
$label = explode(",", $str1);
//var_dump($products);
$copies = array();
$names = array();
for ($i = 0; $i <= 1000; $i++) {
    $copies[$i] = $i;
}

for ($i = 0; $i < sizeof($products); $i++) {
    $names[$products[$i]] = 0;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = 0;
    foreach ($names as $name => $value) {
        $names[$name] = test_input($_POST[$name]);
        $total+=test_input($_POST[$name]);
    }
    $names["fullname"]=  test_input($_POST["fullname"]);
    $names["Total"] = $total;
    $create = $dbhandler->createTable($names, "cdassign", " VARCHAR(100) NOT NULL");
    if ($create) {
        $insert = $dbhandler->insert($names, "cdassign");
        if ($insert) {
            header("Location: message.php");
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
    <div class="row" style="padding-top: 6%;">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h2 style="font-weight: bold; text-align: center; color: background; padding-bottom: 4%;  ">PRODUCTS</h2>
            <?php
            formopen();
            for ($i = 0; $i < sizeof($label); $i++) {
                select($copies, $products[$i], $label[$i]);
            }
            echo "<br>";
//get usernames from database
            $query = $dbhandler->selectAll("cdmarketers");
            $surname = array();
            $firstname = array();
            $user=array();
            if($query!=null){
            while ($temp = mysqli_fetch_array($query)) {
                $surname[] = $temp["surname"];
                $firstname[] = $temp["firstname"];
            }
            for($i=0; $i<sizeof($surname); $i++){
                $user[$i]=$surname[$i]." ".$firstname[$i];
            }
            }
            select($user, "fullname", "Assigned To");
            submitbutton("Assign");
            ?>

        </div>
        <div class="col-sm-4"></div>
    </div>

</div>
</body>
</html>