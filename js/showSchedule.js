function showSchedule(key) {
  var xhttp;  
  if (key == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint2").innerHTML = this.responseText;
    }
  };
  
  xhttp.open("GET", "/STEM/showSchedule.php?q="+key, true);
  xhttp.send();
}