function addUsageAction(branchid,action) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/addaction`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            action : action 
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

function addUsageFrequency(branchid,frequency){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/drug/addfrequency`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            branchid : branchid,
            frequency : frequency 
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
function addUsageUsetime(branchid,usetime){

    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/drug/addusetime`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            branchid : branchid,
            usetime : usetime 
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

function editUsageAction(branchid,action,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/editaction`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid,
          action : action 
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

function deleteUsageAction(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deleteaction`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function editUsageFrequency(branchid,frequency,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/editfrequency`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          frequency : frequency 
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

function deleteUsageFrequency(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deletefrequency`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function editUsageUsetime(branchid,usetime,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/editusetime`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          usetime : usetime 
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

function deleteUsageUsetime(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deleteusetime`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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
function addUnit(branchid,unit){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/addunit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          branchid : branchid,
          unit : unit 
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

function editUnit(branchid,unit,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/editunit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          unit : unit 
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

function deleteUnit(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deleteunit`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function addVender(branchid,vender){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/addvender`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          branchid : branchid,
          vender : vender 
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

function editVender(branchid,vender,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/editvender`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          vender : vender 
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
function deleteVender(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deletevender`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function addDrugControl(branchid,drugcontrol){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/adddrugcontrol`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          branchid : branchid,
          drugcontrol : drugcontrol 
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
function editDrugControl(branchid,drugcontrol,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/editdrugcontrol`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          drugcontrol : drugcontrol 
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
function deleteDrugControl(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deletedrugcontrol`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function addHint(branchid,hint){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/addhint`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          branchid : branchid,
          hint : hint 
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

function editHint(branchid,hint,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/edithint`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          branchid : branchid,
          hint : hint
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
function deleteHint(branchid,id) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/deletehint`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          branchid : branchid
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

function searchDrug(branchid,search) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `${route.url}/api/drug/search`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          branchid : branchid,
          search : search
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

function addDrugFast(branchid,drugname,genericname,printname,therapeutic){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/drug/adddrugfast`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          branchid : branchid,
          drugname : drugname, 
          genericname : genericname,
          printname : printname,
          therapeutic : therapeutic
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

export {addUsageAction,addUsageFrequency,addUsageUsetime,editUsageAction,editUsageFrequency,
  editUsageUsetime,deleteUsageAction,deleteUsageFrequency,deleteUsageUsetime,addUnit,
  editUnit,deleteUnit,addVender,editVender,deleteVender,addDrugControl,editDrugControl,deleteDrugControl,
  addHint,editHint,deleteHint,searchDrug,addDrugFast
}