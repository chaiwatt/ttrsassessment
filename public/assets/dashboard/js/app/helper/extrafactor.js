function getExtraFactor(subclusterid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/extrafactor/get`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            subclusterid : subclusterid
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

export {getExtraFactor}