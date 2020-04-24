function addMedicalCard(branchid,medicalcard) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/medicalcard/addmedicalcard`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            medicalcard : medicalcard
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

  function deleteMedicalCard(branchid,medicalcardid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/medicalcard/deletemedicalcard`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            medicalcardid : medicalcardid
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

  function editMedicalCard(branchid,medicalcard,medicalcardid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/medicalcard/editmedicalcard`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
            medicalcard : medicalcard,
            medicalcardid : medicalcardid
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
  export {addMedicalCard,deleteMedicalCard,editMedicalCard}