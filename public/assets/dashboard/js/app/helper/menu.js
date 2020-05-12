
function getMenu(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/menu/getmenu`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              id : id
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

export {getMenu}