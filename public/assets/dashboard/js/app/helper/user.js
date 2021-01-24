function updateVerifyExpert(userid,status){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/user/updateverifyexpert`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            userid: userid,
            status: status
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

  export {updateVerifyExpert}