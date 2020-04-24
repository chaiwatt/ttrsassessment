function check(hid,branchid) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/hid/check`,
          type: 'POST',
          dataType: "json",
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            hid : hid,
            branchid : branchid
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