function addHospitalList(branchid,name,address,provinceid,amphurid,tambolid,phone) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/hospitallist/addhospitallist`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            name : name,
            address : address,
            provinceid : provinceid,
            amphurid : amphurid,
            tambolid : tambolid,
            phone : phone
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

  function searchHospital(hospitallistid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/hospitallist/search`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            hospitallistid : hospitallistid
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
  function editHospitalList(branchid,hospitallistid,name,address,provinceid,amphurid,tambolid,phone) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/hospitallist/edithospitallist`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            hospitallistid : hospitallistid,
            name : name,
            address : address,
            provinceid : provinceid,
            amphurid : amphurid,
            tambolid : tambolid,
            phone : phone
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

  function deleteHospitalList(branchid,hospitallistid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/hospitallist/deletehospitallist`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            hospitallistid : hospitallistid,
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


  export {addHospitalList,searchHospital,editHospitalList,deleteHospitalList}