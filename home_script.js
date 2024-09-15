//Sticky naviagation bar
document.addEventListener("DOMContentLoaded", function(event) {
    var scrollpos = localStorage.getItem('scrollpos');
    if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};

window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
function myFunction() {
if (window.pageYOffset >= sticky) {
navbar.classList.add("sticky")
} else {
navbar.classList.remove("sticky");
}
}

//Redirect to Order when item clicked on home
const dish1 = document.querySelector('.dish1');
dish1.addEventListener('click', function() {
window.location.href = "order.php";
});

const dish2 = document.querySelector('.dish2');
dish2.addEventListener('click', function() {
window.location.href = "order.php";
});

const dish3 = document.querySelector('.dish3');
dish3.addEventListener('click', function() {
window.location.href = "order.php";
});
