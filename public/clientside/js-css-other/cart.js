
function increaseValue() {
    var value = parseInt(document.getElementById('quantity').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('quantity').value = value;
    updateTotal(); // Call any function you want when the value changes
}

function decreaseValue() {
    var value = parseInt(document.getElementById('quantity').value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
    if(value < 1) {
        value = 1;
    }
    document.getElementById('quantity').value = value;
    updateTotal(); // Call any function you want when the value changes
}

function updateTotal() {
var priceText = document.getElementById("price").innerText;
var price = parseFloat(priceText.replace('$', '').trim());

var quantity = document.getElementById("quantity").value;
var total = parseFloat(price) * parseInt(quantity); // Convert string to number
document.getElementById("totalprice").innerHTML = "$" + total; // Set the total as the content
document.getElementById("subtotal").innerHTML = "$" + total; // Set the total as the content
document.getElementById("total").innerHTML = "$" + total; // Set the total as the content
}

