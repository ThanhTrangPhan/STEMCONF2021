function change_info() {
	var btn = document.getElementById("change");
	var form = document.getElementById("form");
	if (btn.value =="change"){
		btn.value ="update";
		alert(btn.value);
		document.getElementById("update").textContent="Cập nhập thông tin";
		document.getElementById("name").contentEditable = true;
		document.getElementById("email").contentEditable = true;
		document.getElementById("phone").contentEditable = true;
		document.getElementById("dob").contentEditable = true;
		document.getElementById("gender").contentEditable = true;
	} else {
		btn.value="change";
		document.getElementById("change").textContent="Thay đổi thông tin";
		document.getElementById("name").contentEditable = false ;
		document.getElementById("email").contentEditable = false;
		document.getElementById("phone").contentEditable = false;
		document.getElementById("dob").contentEditable = false;
		document.getElementById("gender").contentEditable = false;


		var name = $("#name").text(); 
		var email = $("#email").text();
		var phone = $("#phone").text();
		var dob = $("#dob").text();
		var gender = $("#gender").text();
		var id = $("#id").text();
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