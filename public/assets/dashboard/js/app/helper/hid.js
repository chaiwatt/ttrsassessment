function check(hid) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/hid/check`,
          type: 'POST',
          dataType: "json",
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            hid : hid
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
  export {check}