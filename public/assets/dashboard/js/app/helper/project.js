function addAbtract(lines,id){
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

function getTechDevLevel(id,full_tbp_id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdevlevel/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'full_tbp_id': full_tbp_id
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


function editTechDevLevel(id,technology,presenttechnology,projecttechnology){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/techdevlevel/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'technology': technology,
          'presenttechnology': presenttechnology,
          'projecttechnology': projecttechnology
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

function addPlan(id,detail,month,ganttnummonth,ganttyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/plan/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'detail': detail,
          'months': month,
          'startyear': ganttyear,
          'numofmonth': ganttnummonth
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

function getPlan(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/plan/get`,
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

function editPlan(id,detail,month){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/plan/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'detail': detail,
          'months': month,
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

function deletePlan(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/plan/delete`,
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

function deleteCompanydoc(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/companydoc/delete`,
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

function getMonth(fulltbpid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/project/plan/getmonth`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'fulltbpid': fulltbpid
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

export {addAbtract,addProduct,addProductDetail,getTechDevLevel,addTechDev,addTechDevLevel,editTechDevLevel,deleteTechDevLevel,addTechDevProblem,
  editProjectCertify,deleteCertifyAttachement,deleteAwardAttachement,deleteStandardAttachement,addPlan,getPlan,editPlan,deletePlan,deleteCompanydoc,getMonth}