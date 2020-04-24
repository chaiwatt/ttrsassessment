function addCcTemplate(branchid,name,detail) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/cc/addcctemplate`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            name : name,
            detail : detail
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
  
  export {addCcTemplate}