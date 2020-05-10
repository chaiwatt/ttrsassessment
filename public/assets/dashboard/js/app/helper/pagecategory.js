function addCategory(category){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagecategory/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            category : category
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

function editCategory(id,category){
    console.log(id + '  ' + category);
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagecategory/edit`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            category : category
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

function deleteCategory(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/pagecategory/delete`,
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
export {addCategory,editCategory,deleteCategory}