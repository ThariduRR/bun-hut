
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


//View cart on onclick

function openCart() {
document.getElementById('cart').style.width = '500px';
}

function closeCart() {
document.getElementById('cart').style.width = '0px';
}


var cartArr = [];
//Add items to cart
var addItemId = 0;
function addToCart(item){

addItemId += 1;
var selectedItem = document.createElement('div');
selectedItem.classList.add('cartItem');
selectedItem.setAttribute('id','addeditem'+addItemId);
var img = document.createElement('img');
img.setAttribute('src',item.children[0].currentSrc);
var title = document.createElement('p');
title.classList.add('cartName');
title.innerText = item.children[1].innerText;

var price = document.createElement('p');
price.classList.add('cartPrice');
price.innerText = item.children[6].innerText;
price.setAttribute('id', 'prcId'+addItemId);

var tmpprice = document.createElement('span');
tmpprice.classList.add('spanPrice');
tmpprice.innerText = item.children[6].innerText;
tmpprice.setAttribute('id', 'tmpPrceId'+addItemId);

var cancel = document.createElement('button');
cancel.classList.add('cancel');
cancel.innerText = "X";
cancel.setAttribute('onclick', 'del(addeditem'+addItemId+')');

var qty = document.createElement("input");
qty.classList.add('qtyClass');
qty.setAttribute('type', 'text');
qty.setAttribute('value', '1');
qty.setAttribute('id', 'qtyId'+addItemId);
qty.setAttribute('onchange', 'testOnchange(addeditem'+addItemId+')');

var cartItems = document.getElementById('cartNav');
selectedItem.append(img);
selectedItem.append(cancel);
selectedItem.append(qty);
selectedItem.append(title);
selectedItem.append(price);
selectedItem.append(tmpprice);
cartItems.append(selectedItem);

window.alert(title.innerHTML + " added to the Cart");

var strPrice = item.children[6].innerText;
var newPrice = parseInt(strPrice.replace(/[^\d\.]+/,''));

var tempTot = document.getElementById('total');
var tempTot2 = tempTot.innerHTML;
var currentTot = parseInt(tempTot2.replace(/[^\d\.]+/,''));

var newTot = +currentTot + +newPrice;


document.getElementById('total').innerText = newTot;


}





function testOnchange(item){




var qty = item.children[2].value;

var strPrice = item.children[5].innerText;


var cleanPrice = parseInt(strPrice.replace(/[^\d\.]+/,''));

var childDivs = document.getElementById('cartNav').querySelectorAll('div').length;

var pdiv = document.getElementById('cartNav');

var children = pdiv.children;
var newtotal = 0;




var tempTot = document.getElementById('total');
var tempTot2 = tempTot.innerHTML;
var currentTot = parseInt(tempTot2.replace(/[^\d\.]+/,''));

var allSingle = (cleanPrice*qty);



var total = +currentTot + +allSingle;



item.children[4].innerText = "Rs "+allSingle+".00";

for (var i = 0; i < childDivs; i++) {
var child = children[i];
var tmpstrPrice = child.children[4].innerText;
var tmpcleanPrice = parseInt(tmpstrPrice.replace(/[^\d\.]+/,''));

newtotal = +newtotal + +tmpcleanPrice;
}

document.getElementById('total').innerText = newtotal;

}


//delete item from the cart
function del(item){

var pr = item.children[4].innerText;
var tId = item.id;
document.getElementById(tId).remove();
testOnchange(item);

}
