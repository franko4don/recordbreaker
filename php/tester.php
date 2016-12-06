<?php
include 'design.php';
navbar("tester");
echo "<br><br><br><br>";
?>

                <script>  
        var test="";             
function showHint(str) {

  if (str.length==0) { 
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        test=xmlhttp.responseText;
      document.getElementById("txtHint").innerHTML=test;
               $(document).ready(function(){
          //  confirm("state is "+test);      
         $('[data-toggle="popover"]').popover(test); 
     confirm("state is "+test);
   
});
    }
  }
  xmlhttp.open("GET","test.php?q="+str,true);
  xmlhttp.send();



}
        </script>

<body>
  

 
<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input type="text" id="input" onkeyup="showHint(this.value)" data-toggle="popover" title="Popover Header" data-content="Content">
 <p>Suggestions: <span id="txtHint"></span></p>   
</body>
</html>
