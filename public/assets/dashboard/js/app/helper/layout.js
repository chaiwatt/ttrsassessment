
function editLayout(data,layout){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/layout/edit`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              data : data,
              layout : layout,
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

export {editLayout}