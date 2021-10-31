function del(name){
    return confirm("Bạn có chắc muốn xóa "+name+" ?");
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