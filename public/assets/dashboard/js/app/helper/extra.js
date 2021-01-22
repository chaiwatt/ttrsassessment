function getExtraCategory(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/extra/getextracategory`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
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

function getExtra(evid,id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/extra/getextra`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
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

function addExtra(evid,categoryid,criteria){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/addextra`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          evid : evid,
          categoryid : categoryid,
          criteria : criteria
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

function deleteCategoryExtraTransaction(evid,categoryid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/deletecategoryextratransaction`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          evid : evid,
          categoryid : categoryid
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

function deleteCriteriaExtraTransaction(evid,categoryid,creteria){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/deletecriteriaextratransaction`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          evid : evid,
          categoryid : categoryid,
          creteria : creteria
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

function editExtraWeight(evid,id,weight){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/editextraweight`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          evid : evid,
          id : id,
          weight : weight
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

function addExtraScore(id,evid,score){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/addscore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          evid : evid,
          score : score
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

function addExtraComment(id,evid,comment){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/addcomment`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          evid : evid,
          comment : comment
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

function showConflictScore(criteriaid,evid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/extra/showconflictscore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          criteriaid : criteriaid,
          evid : evid
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


export {getExtraCategory,getExtra,addExtra,deleteCategoryExtraTransaction,deleteCriteriaExtraTransaction,editExtraWeight,addExtraScore,addExtraComment,showConflictScore}