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

// function showContent(id, btn, contents){
//   for (var i = 0; i < contents.length; i++) {
//       contents[i].style.display = "none";
//   }
//   var content = document.getElementById(id);
//   // alert(buttons);
//   content.style.display = "block";
//   // document.getElementById(id).style.display = 'block';
// }
// for (var i = 0; i < btn.length; i++) {
//   btn[i].addEventListener("click", function(){
//       var idbtn = this.textContent;
//       for (var i = 0; i < btn.length; i++) {
//           btn[i].classList.remove("active");
//       }
//       this.className += " active";
//       showContent(idbtn);
//   });
// }
function ajaxPost(id, url){
  $(id).submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: url,
        data: $(this).serializeArray(),
        success: function(response) {
            response = JSON.parse(response);
            if (response.status == "0") {
                alert(response.message);
                console.log(response.message);
            } else {
                alert(response.message);
                location.reload();
            }
        }
    });
});
}

// function sumItem(qty, price){

//   var sum = qty * price;
//   return sum.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
// }
