function getSubPillar(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getsubpillar`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

  function getSubPillarIndex(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getsubpillarindex`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

  function getCriteria(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getcriteria`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

export {getSubPillar,getSubPillarIndex,getCriteria}