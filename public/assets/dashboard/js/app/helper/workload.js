function getWorkLoadLeader(userid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/projectassignment/getworkloadleader`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'userid': userid
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

function getWorkLoadCoLeader(userid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/dashboard/admin/project/projectassignment/getworkloadcoleader`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'userid': userid
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

export {getWorkLoadLeader,getWorkLoadCoLeader}