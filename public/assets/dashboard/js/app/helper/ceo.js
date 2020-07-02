function saveCEO(name,lastname){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/ceo/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            name : name,
            lastname :lastname,
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


export {saveCEO}