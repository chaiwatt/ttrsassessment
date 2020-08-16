function getSubCluster(clusterid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/subcluster/get`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            clusterid : clusterid
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

export {getSubCluster}