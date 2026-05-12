// Show alert (new reusable version)
function showAlert(message, type = "success") {
const alert = document.createElement("div");

alert.className = `alert ${type}`;
alert.innerText = message;

document.body.appendChild(alert);

// initial hidden state
alert.style.opacity = "0";
alert.style.transform = "translateY(-10px)";
alert.style.transition = "0.4s ease";

// show animation
setTimeout(() => {
alert.style.opacity = "1";
alert.style.transform = "translateY(0)";
}, 50);

// hide after 3s
setTimeout(() => {
alert.style.opacity = "0";
alert.style.transform = "translateY(-10px)";

setTimeout(() => {
alert.remove();
}, 400);
}, 3000);
}


// Laravel flash message handler
document.addEventListener("DOMContentLoaded", function () {
if (window.flashSuccess) {
showAlert(window.flashSuccess, "success");
}

if (window.flashError) {
showAlert(window.flashError, "error");
}
});

// Loading screen
window.addEventListener("load", function () {
const loading = document.getElementById("loadingScreen");
if (loading) {
loading.style.display = "none";
}
});
