
function searchName(name){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/search/officer/name`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          name : name
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

function searchBranch(branch){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/officer/branch`,
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
          url: `${route.url}/api/search/officer/projectname`,
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
          url: `${route.url}/api/search/officer/projectstatus`,
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

export {searchName,searchBranch,searchProjectname,searchProjectstatus}