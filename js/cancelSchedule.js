function cancelSchedule(key){
	var ind= parseInt(key);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
	    var myObj = JSON.parse(this.responseText );
	    
	    $.ajax({
                url: "cancelSchedule.php",
                type: "POST",
                data: {'no': myObj[key] },                   
                success: function()
                            {
                                alert("Hủy thành công!");
                                var elm=document.getElementById("row"+key);
                                elm.remove();
                                reload();                                    
                            }
           } );	
	  }
	};

	xmlhttp.open("GET", "/STEM/getListSubject.php", true);

	xmlhttp.send();
	
	
}