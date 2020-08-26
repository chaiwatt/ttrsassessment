function getPillar(){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/pillar/getpillar`,
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

export {getPillar}