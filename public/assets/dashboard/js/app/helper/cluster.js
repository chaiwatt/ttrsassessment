function getCluster(){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/cluster/get`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          success: function(data) {
            resolve(data)
          },
          error: function(error) {
            reject(error)
          },
        })
      })
}

export {getCluster}