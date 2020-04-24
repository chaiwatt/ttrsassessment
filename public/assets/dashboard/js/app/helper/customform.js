function createScreenForm(branchid,formdata) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/customform/screen/create`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formdata,
        success: function(data) {
          resolve(data)
        },
        error: function(error) {
          reject(error)
        },
      })
    })
  }

  export {createScreenForm}