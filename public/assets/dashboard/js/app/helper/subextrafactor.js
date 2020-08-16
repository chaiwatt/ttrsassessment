function getSubExtraFactor(extrafactorid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/subextrafactor/get`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            extrafactorid : extrafactorid
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

export {getSubExtraFactor}