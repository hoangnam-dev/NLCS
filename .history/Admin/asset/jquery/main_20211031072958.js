function del(name){
    return confirm("Bạn có chắc muốn xóa "+name+" ?");
}
function getElement(id){
  var data = $('#'+id).val();
  return data;
}
// popup
function popupOpen(id) {
    var idmodal = id;
    document.getElementById(idmodal).style.display = "block";
  }
  
  // Popup Close
  function popupClose(id) {
    var idmodal = id;
    document.getElementById(idmodal).style.display = "none";
  }