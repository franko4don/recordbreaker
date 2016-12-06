
function show(){
    window.confirm("hurray");
}


function showHint(str) {
    var test="hide";
  if (str.length==0) { 
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      test=xmlhttp.responseText;//
      document.getElementById("txtHint").innerHTML=test;
    }
  }
  xmlhttp.open("GET","test.php?q="+str,true);
  xmlhttp.send();

}

