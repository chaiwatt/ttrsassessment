function addPerformance(id,performanceyear,performanceincome,performancenetprofit,performancetotalasset,performancetotalliability){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/businessplan/performance/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              id : id,
              performanceyear : performanceyear,
              performanceincome : performanceincome,
              performancenetprofit : performancenetprofit,
              performancetotalasset : performancetotalasset,
              performancetotalliability : performancetotalliability
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

function deletePerformance(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/businessplan/performance/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            id : id
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

export {addPerformance,deletePerformance}
