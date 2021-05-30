
function changeInfo() {
	var form = document.getElementById("personal");
	// for (var i = 0; i < form.length; i++) {
	// 	alert(form[i].value);
	// }
    
    if (form[6].value =="change"){
		form[6].value ="update";
		document.getElementById("change").textContent="Cập nhập thông tin";
		document.getElementById("name").disabled = false;
		document.getElementById("email").disabled = false;
		document.getElementById("phone").disabled = false;
		document.getElementById("dob").disabled = false;
		document.getElementById("gender").disabled = false;
		
	} else {
		form[6].value="change";
		document.getElementById("change").textContent="Thay đổi thông tin";
		document.getElementById("name").disabled = true ;
		document.getElementById("email").disabled = true;
		document.getElementById("phone").disabled = true;
		document.getElementById("dob").disabled = true;
		document.getElementById("gender").disabled = true;
		var name = form[0].value; 
		var email = form[1].value;
		var phone = form[4].value;
		var dob = form[2].value;
		var gender = form[5].value;
		var id = form[3].value;
		name = $.trim(name);
		email=$.trim(email);
		phone=$.trim(phone);
		dob=$.trim(dob);
		gender=$.trim(gender);
		id=$.trim(id);
		$.ajax({
                url: "update_info.php",
                type: "POST",
                data: {'id':id, 'name': name, 'email':email, 'phone':phone, 'dob':dob, 'gender':gender},                   
                success: function()
                            {
                                alert("Cập nhập thành công!");                                    
                            }
           } );
	}
}

