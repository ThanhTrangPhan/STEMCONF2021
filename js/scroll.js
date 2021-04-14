var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("mynavbar").style.top = "0";
  } else {
    document.getElementById("mynavbar").style.top = "-85px";
  }
  prevScrollpos = currentScrollPos;
}