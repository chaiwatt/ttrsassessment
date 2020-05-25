
function addRequest(id,toids){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/friend/addrequest`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              id : id,
              toids : toids
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


function deleteRequest(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/friend/deleterequest`,
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

function acceptRequest(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/friend/acceptrequest`,
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

function rejectRequest(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/friend/rejectrequest`,
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

function deleteFriend(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/friend/deletefriend`,
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

export {addRequest,deleteRequest,acceptRequest,rejectRequest,deleteFriend}