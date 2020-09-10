function getWeigth(evid,subpillarindex){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/pillarindexweigth/getweigth`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            subpillarindex : subpillarindex
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

function editWeigth(evid,subpillarindex,weigth){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/pillarindexweigth/editweigth`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            subpillarindex : subpillarindex,
            weigth: weigth
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

  export {editWeigth,getWeigth}