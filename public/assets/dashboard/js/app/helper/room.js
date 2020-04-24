function list(workstationid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/room/list`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            workstationid : workstationid
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

export {list}