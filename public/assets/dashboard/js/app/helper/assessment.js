
function addAssessment(companyid,status){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            companyid : companyid,
            status : status,
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


export {addAssessment}