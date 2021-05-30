var x=0;
var countdownDate;
function setTimer(){
	clearInterval(x);
	countdownDate = document.getElementById("datetime").value;
	var str=countdownDate+"Z";
	countdownDate= new Date(countdownDate).getTime();
	update();
	localStorage.setItem("end",countdownDate);
	doTimer();
	
}

function doTimer(){
	x= setInterval(function(){
		countdownDate=Number(localStorage.getItem("end"));
		
			var now= new Date().getTime();
			var distance=countdownDate-now;

			 var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		  document.getElementById("timer").innerHTML = "Còn "+days + " ngày, " + hours + " giờ, "+ minutes + " phút, " 
		  + seconds + " giây! ";
		    if (distance < 0) {
			    clearInterval(x);
			    clearInterval(interval);
      			clearInterval(countdown);
      			localStorage.removeItem("end");
			    document.getElementById("timer").innerHTML = "Rocket launch! Đã đến giờ rồi!";
		  	}
	}, 1000);
	

}


window.onload = function () {
  countdownDate=parseInt(localStorage.getItem("end"));
  doTimer();
};