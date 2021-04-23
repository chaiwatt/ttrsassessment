
$(document).on('click', '.togglebar', function(e) {
    var status = 1;
    if ($("body").hasClass("sidebar-xs")) {
        status = 1
    }else{
        status = 0;
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