function getSubIsic(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/company/getsubisic`,
          type: 'POST',
          dataType: "json",
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
  export {getSubIsic}