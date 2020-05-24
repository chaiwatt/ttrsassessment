
function addRequest(id,toids){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/friend/friendrequest`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              id : id,
              toids : toids
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

export {addRequest}