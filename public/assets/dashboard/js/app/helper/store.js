function search(drugid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/store/search`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            drugid : drugid 
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

  export {search}