// console.log($("body").hasClass("sidebar-xs"));
var realstatus = $("body").hasClass("sidebar-xs");
$(document).on('click', '.togglebar', function(e) {
    var status = 1;
    if (realstatus == false) {
        status = 1
        realstatus == true
    }else{
        status = 0;
        realstatus == false
    }

    saveToggleStatus(status).then(data => {

    })
    .catch(error => {})
});

function saveToggleStatus(status){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/togglebar/save`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            status : status
          },
          success: function(data) {
            resolve(data)
          },
          error: function(error) {
            reject(error)
          },
        })
    })
}