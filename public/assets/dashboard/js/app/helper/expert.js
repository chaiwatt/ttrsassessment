function deleteExpereince(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/expert/deleteexperience`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id
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

function deleteEducation(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/expert/deleteeducation`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id
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

function addExpertfield(expertfieldnum,expertfielddetail){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/expert/addExpertfield`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          expertfieldnum : expertfieldnum,
          expertfielddetail : expertfielddetail
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

export {deleteEducation,deleteExpereince,addExpertfield}