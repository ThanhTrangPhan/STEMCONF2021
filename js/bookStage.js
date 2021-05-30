function bookStage() {
  var x = document.getElementById("theme").selectedIndex;
  var theme = document.getElementsByTagName("option")[x].textContent();
  var time =document.getElementsById("timOn").value;
  var sub= document.getElementsByTagName("subject").value;
  if(theme==""&&time==""&&sub==""){
    alert("Hãy nhập đầy đủ thông tin!");
    return;
  }
  $.ajax({
                url: "book_stage.php",
                type: "POST",
                data: {'theme':theme, 'time': time, 'sub':sub},                   
                success: function()
                            {
                                document.getElementById("txtHint2").innerHTML = this.responseText;                                 
                            }

           } );


}
