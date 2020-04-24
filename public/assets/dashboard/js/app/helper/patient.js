function searchPatient(branchid,search) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/search`,
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
  
  function searchPatientById(branchid,id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/searchbyid`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            branchid : branchid,
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
  function addDrugAllergy(patientid,drugid,note) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/adddrugallergy`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            drugid : drugid,
            note : note
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

  function deleteDrugAllergy(patientid,allergyid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletedrugallergy`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            allergyid : allergyid,
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

  
  function addCongenitalDisease(patientid,icd10,note) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/addcongenitaldisease`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            icd10 : icd10,
            note : note
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

  function deleteCongenitalDisease(patientid,icd10) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletecongenitaldisease`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            icd10 : icd10
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

  function addFoodAllergy(patientid,foodallergy,note) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/addfoodallergy`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            foodallergy : foodallergy,
            note : note
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

  function deleteFoodAllergy(patientid,foodallergyid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletefoodallergy`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            foodallergyid : foodallergyid
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

  function addContactPerson(patientid,prefixid,name,lastname,relation,phone,email) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/addcontactperson`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            prefixid : prefixid,
            name : name,
            lastname : lastname,
            relation : relation,
            phone : phone,
            email : email
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

  function deleteContactPerson(patientid,contactpersonid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletecontactperson`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            contactpersonid : contactpersonid
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

  function addMedicalCard(patientid,patientmedicalcardtypeid,medicalcardnumber,mainhospitalid,subhospitalid,activedate,expireddate,credit) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/addmedicalcard`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            patientmedicalcardtypeid : patientmedicalcardtypeid,
            medicalcardnumber : medicalcardnumber,
            mainhospitalid : mainhospitalid,
            subhospitalid : subhospitalid,
            activedate : activedate,
            expireddate : expireddate,
            credit : credit
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

  function deleteMedicalCard(patientid,medicalcardid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletemedicalcard`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
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
  
  function addPatientNote(patientid,note,attachfile) {
    console.log(attachfile);
    var formData = new FormData();
    formData.append("attachfile", attachfile);
    formData.append('patientid',patientid);
    formData.append('note',note);

    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/addpatientnote`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        cache: false,
        processData: false, 
        contentType: false,
        success: function(data) {
          resolve(data)
        },
        error: function(error) {
          reject(error)
        },
      })
    })
  }

  function deletePatientNote(patientid,patientnoteid) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/patient/deletepatientnote`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            patientid : patientid,
            patientnoteid : patientnoteid
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

  export {searchPatient,searchPatientById,addDrugAllergy,deleteDrugAllergy,addCongenitalDisease,deleteCongenitalDisease,addFoodAllergy,
    deleteFoodAllergy,addContactPerson,deleteContactPerson,addMedicalCard,deleteMedicalCard,addPatientNote,deletePatientNote}