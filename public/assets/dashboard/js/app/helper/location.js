function province() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/location/province`,
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

function amphur(provinceid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/location/amphur`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              proviceid : provinceid
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
function tambol(amphurid){

    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/location/tambol`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              amphurid : amphurid
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

export {province,amphur,tambol}