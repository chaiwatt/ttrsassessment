function searchBranch(branch){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/expert/branch`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            branch : branch
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

function searchProjectname(projectname){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/expert/projectname`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            projectname : projectname
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

function searchProjectstatus(projectstatus){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/expert/projectstatus`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            projectstatus : projectstatus
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

export {searchBranch,searchProjectname,searchProjectstatus}