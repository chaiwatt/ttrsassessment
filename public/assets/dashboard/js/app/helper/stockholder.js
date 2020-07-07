  function addStockHolder(employid,ceorelation){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/stockholder/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id:employid,
            ceorelation:ceorelation,
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

  function deleteStockHolder(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/stockholder/delete`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id:id,
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

  export {addStockHolder,deleteStockHolder}