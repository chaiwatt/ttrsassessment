import * as Store from './store.js';
$( document ).ready(function() {
    var id = getUrlVars()["id"];
    if (typeof id !== "undefined") {
        $("#drug").val(id).change();
        Store.search(id).then(data => {
            $("#name").val(data.name)
            $("#genericname").val(data.genericname)
          })
    }else{
        console.log('bad param');
    }
});
$(function () {
    $('#stockupdate').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      clearButton: true,
      weekStart: 1,
      cancelText: "ยกเลิก",
      okText: "ตกลง",
      clearText: "เคลียร์",
      time: false
    });
});
$(function () {
    $('#expiredate').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      clearButton: true,
      weekStart: 1,
      cancelText: "ยกเลิก",
      okText: "ตกลง",
      clearText: "เคลียร์",
      time: false
    });
});
$('#drug').on('change', function() {
    if ($(this).val() =='' || $(this).val() == '0') return;
    Store.search($(this).val()).then(data => {
        $("#name").val(data.name)
        $("#genericname").val(data.genericname)
      })
      .catch(error => {
          // console.log(error)
      })
});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
    });
    return vars;
}



