 setTimeout(function() {
 const alert = document.querySelector('.alert');

 if (alert) {
 alert.style.transition = "0.5s";
 alert.style.opacity = "0";
 alert.style.transform = "translateY(-10px)";

 setTimeout(() => {
 alert.style.display = "none";
 }, 500);
 }

 }, 3000);

 window.addEventListener("load", function() {
 document.getElementById("loadingScreen").style.display = "none";
 });
