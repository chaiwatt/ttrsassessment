function saveEmploy(prefix,name,lastname,position,phone,workphone){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/employ/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            prefix : prefix,
            name : name,
            lastname :lastname,
            position :position,
            phone :phone,
            workphone :workphone,
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

function getEmploy(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
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

function editEmploy(id,name,lastname,position,phone,workphone){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id,
          name : name,
          lastname :lastname,
          position :position,
          phone :phone,
          workphone :workphone,
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

function deleteEmployInfo(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id
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

function addEmployEducation(id,employeducationlevel,employeducationinstitute,employeducationmajor,employeducationyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/education/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id,
          employeducationlevel : employeducationlevel,
          employeducationinstitute :employeducationinstitute,
          employeducationmajor :employeducationmajor,
          employeducationyear :employeducationyear,
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


function addEmployExperience(id,employexperiencestartdate,employexperienceenddate,employexperiencecompany,employexperiencebusinesstype,employexperiencestartposition,employexperienceendposition){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/experience/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id,
          employexperiencestartdate : employexperiencestartdate,
          employexperienceenddate :employexperienceenddate,
          employexperiencecompany :employexperiencecompany,
          employexperiencebusinesstype :employexperiencebusinesstype,
          employexperiencestartposition :employexperiencestartposition,
          employexperienceendposition :employexperienceendposition,
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

function addEmployTraining(id,employtrainingdate,employtrainingcourse,employtrainingowner){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/training/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id,
          employtrainingdate : employtrainingdate,
          employtrainingcourse :employtrainingcourse,
          employtrainingowner :employtrainingowner,
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

function deleteEmployEducation(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/education/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id
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

function deleteEmployExperience(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/experience/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id
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

function deleteEmployTraining(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/training/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id
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

function getEmploys(companayid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/getlist`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          companayid:companayid
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

function editEmployQuantity(id,department1_qty,department2_qty,department3_qty,department4_qty,department5_qty){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/employ/quantity/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id:id,
          department1_qty :department1_qty,
          department2_qty :department2_qty,
          department3_qty :department3_qty,
          department4_qty :department4_qty,
          department5_qty :department5_qty,
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

export {saveEmploy,getEmploy,editEmploy,addEmployEducation,addEmployExperience,addEmployTraining,deleteEmployEducation,
  deleteEmployExperience,deleteEmployTraining,getEmploys,deleteEmployInfo,editEmployQuantity}