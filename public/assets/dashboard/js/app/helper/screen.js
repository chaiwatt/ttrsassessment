function searchQuickScreen(branchid,search) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/screen/searchquickscreen`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            search : search
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


  function addQuickScreen(branchid,quickscreen) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/screen/addquickscreen`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            quickscreen : quickscreen
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

  function editQuickScreen(branchid,quickscreenid,quickscreen) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/screen/editquickscreen`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            quickscreenid : quickscreenid,
            quickscreen : quickscreen,
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

  function deleteQuickScreen(branchid,quickscreenid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/screen/deletequickscreen`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            quickscreenid : quickscreenid,
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

  export {searchQuickScreen,addQuickScreen,editQuickScreen,deleteQuickScreen}