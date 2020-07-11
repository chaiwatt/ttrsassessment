function addNeed(lines,id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/market/need/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'lines': lines,
            'id': id,
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

function addSize(lines,id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/market/size/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'lines': lines,
            'id': id,
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
function addShare(lines,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/market/share/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'lines': lines,
          'id': id,
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
function addCompetitive(lines,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/market/competitive/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'lines': lines,
          'id': id,
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

export {addNeed,addSize,addShare,addCompetitive}