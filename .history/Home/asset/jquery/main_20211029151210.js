/* ================================================= */
// Function Popup Form
function popupOpen(id) {
  var idmodal = id;
  document.getElementById(idmodal).style.display = "flex";
}

// Popup Close
function popupClose(id) {
  var idmodal = id;
  document.getElementById(idmodal).style.display = "none";
}

/* ================================================= */
// Function Quantity Input Product
function qty_plus(quantity) {
  quantity = quantity + 1;
  return quantity;
}
function qty_minus(quantity) {
  if (quantity > 1) {
    quantity--;
  } else {
    return quantity;
  }
  return quantity;
}

function getElement(id) {
  return document.getElementById(id).value.trim();
}

//Validate Form
function showErr(key, message) {
  document.getElementById("error-" + key).innerHTML = message;
}

function formatCash(str) {
  return str.split('').reverse().reduce((prev, next, index) => {
    return ((index % 3) ? next : (next + ',')) + prev
  })
}
function sumItem(qty, price){
  var sum = qty * price;
  return sum;
  // return formatCash(String(sum));
}