function addCompanyProfile(lines){
    console.log(route.url);
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/companyprofile/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'lines': lines,
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

export {addCompanyProfile}