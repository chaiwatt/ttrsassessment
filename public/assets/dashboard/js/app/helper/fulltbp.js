function editApprove(id,val,note){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/editapprove`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            val : val,
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

function editGeneral(id,businesstype,department_qty,department1_qty,department2_qty,department3_qty,department4_qty,department5_qty,
  companyhistory,responsibleprefix,responsiblename,responsiblelastname,responsibleposition,responsibleemail,responsiblephone,responsibleworkphone,responsibleeducationhistory,
  responsibleexperiencehistory,responsibletraininghistory){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/general/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          businesstype : businesstype,
          department_qty : department_qty,
          department1_qty : department1_qty,
          department2_qty : department2_qty,
          department3_qty : department3_qty,
          department4_qty : department4_qty,
          department5_qty : department5_qty,
          companyhistory : companyhistory,
          responsibleprefix : responsibleprefix,
          responsiblename : responsiblename,
          responsiblelastname : responsiblelastname,
          responsibleposition : responsibleposition,
          responsibleemail : responsibleemail,
          responsiblephone : responsiblephone,
          responsibleworkphone : responsibleworkphone,
          responsibleeducationhistory : responsibleeducationhistory,
          responsibleexperiencehistory : responsibleexperiencehistory,
          responsibletraininghistory : responsibletraininghistory
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

function addResearcher(employtype,id,researcherfix,researchername,researcherlastname,researchereducation,researcherexperience,researchertraining){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/general/addresearcher`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          employtype : employtype,
          id : id,
          researcherfix : researcherfix,
          researchername : researchername,
          researcherlastname : researcherlastname,
          researchereducation : researchereducation,
          researcherexperience : researcherexperience,
          researchertraining : researchertraining
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

function deleteResearcher(employtype,id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/general/deleteresearcher`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          employtype : employtype,
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

function editOverAll(id,abtract,productdetail,techdev,techdevproblem,mainproduct,innovation,standard){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/overall/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          abtract : abtract,
          productdetail : productdetail,
          techdev : techdev,
          techdevproblem : techdevproblem,
          mainproduct : mainproduct,
          innovation : innovation,
          standard : standard
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

function editMarketPlan(id,analysis,modelcanvas,swot){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/marketplan/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          analysis : analysis,
          modelcanvas : modelcanvas,
          swot : swot
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
function generatePdf(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/generatepdf`,
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

function editSignature(id,usesignature){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/editsignature`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          usesignature : usesignature
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

export {editApprove,editGeneral,addResearcher,deleteResearcher,editOverAll,editMarketPlan,generatePdf,editSignature}

