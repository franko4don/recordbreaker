<?php
include 'design.php';
include 'classes.php';
navbar("Sales");
echo "<br><br>";
$username = $_SESSION["username"];
if (!isset($username)) {
    header("location: cdlogin.php");
}
$dbhandler = new DBHandler;
$form_handler=new FormHandler;
$str1 = "Microsoft Word 2007,Microsoft Word 2010,Microsoft Word 2013,Microsoft Word 2016,Microsoft Excel 2007,Microsoft Excel 2007,Microsoft Excel 2010,Microsoft Excel 2013,Microsoft Excel 2016,Microsoft PowerPoint 2007,Microsoft PowerPoint 2010,Microsoft PowerPoint 2013,Microsoft PowerPoint 2016,Internet,Corel Draw X5,Operating System,Photoshop";
$variables = "product,amount,copies";
$products = explode(",", $str1);
$temp = explode(",", $variables);
$names = array();
for ($i = 0; $i < sizeof($temp); $i++) {
    $names[$temp[$i]] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($names as $name => $value) {
        $names[$name] = test_input($_POST[$name]);
    }

    $errors = $form_handler->formValidation($names, "cdmarketers");

    if (sizeof($errors) == 0) {
            $names["username"]=$_SESSION["username"]; //to be gotten from session array
            
            $table_check = $dbhandler->createTable($names, "saleupdate"," VARCHAR(100) NOT NULL");
            if ($table_check) {
                $datacheck=$dbhandler->insert($names, "saleupdate");  
                    if($datacheck){
                        echo "<br>Update Successful<br>";
                    }else{
                        echo "<br>Update Unsuccessful<br>";
                    }
            }
        
    
    } else {
        echo "<div class='alert alert-warning'>
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
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h2 style="font-weight: bold; text-align: center; color: background; padding-bottom: 4%;  ">SALES UPDATE</h2>
            <?php
            formopen();
            select($products, "product", "Product");
            number($names["amount"], "Amount", "amount");
            number($names["copies"], "Number of Copies Sold", "copies");
            submitbutton("Update");
            ?>

        </div>
        <div class="col-sm-4"></div>
    </div>

</div>
</body>
</html>