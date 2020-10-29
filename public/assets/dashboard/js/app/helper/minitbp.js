function editApprove(id,val,note){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/minitbp/editapprove`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            val : val,
            note : note
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


export {editApprove}