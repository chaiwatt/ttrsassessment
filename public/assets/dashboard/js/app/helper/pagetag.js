function addTag(tag){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagetag/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            tag : tag
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

function editTag(id,tag){
    console.log(id + '  ' + tag);
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagetag/edit`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            tag : tag
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

function deleteTag(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagetag/delete`,
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
export {addTag,editTag,deleteTag}