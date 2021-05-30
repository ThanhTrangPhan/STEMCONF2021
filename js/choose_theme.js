function showSubject(key) {
  var xhttp;  
  if (key == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  
  xhttp.open("GET", "/STEM/find_theme.php?q="+key, true);
  xhttp.send();
}