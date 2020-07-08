function addAbtract(lines,id){
    console.log(route.url);
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/project/abtract/add`,
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

function addProduct(lines,id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/product/add`,
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
function addProductDetail(lines,id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/productdetail/add`,
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
function addTechDev(lines,id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdev/add`,
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

function addTechDevLevel(id,technology,presenttechnology,projecttechnology){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdevlevel/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'technology': technology,
          'presenttechnology': presenttechnology,
          'projecttechnology': projecttechnology,
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

function deleteTechDevLevel(id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdevlevel/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function addTechDevProblem(lines,id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdevproblem/add`,
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
export {addAbtract,addProduct,addProductDetail,addTechDev,addTechDevLevel,deleteTechDevLevel,addTechDevProblem}