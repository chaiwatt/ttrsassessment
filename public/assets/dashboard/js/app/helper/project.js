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

function editProjectCertify(id,cer1,cer1qty,cer2,cer2qty,cer3,cer3qty,cer4,cer4qty,cer5,cer5qty,cer6,cer6qty,cer7,cer7qty,cer8,cer8qty,cer9,cer9qty,cer10,cer11,cer11qty){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/projectcertify/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id' : id,
          'cer1' : cer1,
          'cer1qty' : cer1qty,
          'cer2' : cer2,
          'cer2qty' : cer2qty,
          'cer3' : cer3,
          'cer3qty' : cer3qty,
          'cer4' : cer4,
          'cer4qty' : cer4qty,
          'cer5' : cer5,
          'cer5qty' : cer5qty,
          'cer6' : cer6,
          'cer6qty' : cer6qty,
          'cer7' : cer7,
          'cer7qty' : cer7qty,
          'cer8' : cer8,
          'cer8qty' : cer8qty,
          'cer9' : cer9,
          'cer9qty' : cer9qty,
          'cer10' : cer10,
          'cer11' : cer11,
          'cer11qty' : cer11qty
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

function deleteCertifyAttachement(id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/projectcertify/upload/delete`,
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

function deleteAwardAttachement(id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/projectaward/delete`,
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

function deleteStandardAttachement(id){
  console.log(route.url);
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/standard/delete`,
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

export {addAbtract,addProduct,addProductDetail,addTechDev,addTechDevLevel,deleteTechDevLevel,addTechDevProblem,editProjectCertify,deleteCertifyAttachement,deleteAwardAttachement,deleteStandardAttachement}