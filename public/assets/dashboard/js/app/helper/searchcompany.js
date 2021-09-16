
function searchProjectname(projectname,issounddex,sounddextype){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/company/projectname`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            projectname : projectname,
            issounddex : issounddex,
            sounddextype : sounddextype
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

function searchIsic(isic,subisic){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/company/isic`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            isic : isic,
            subisic : subisic,
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

function searchIndustrygroup(industrygroup){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/company/industrygroup`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            industrygroup : industrygroup
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


function searchCompanyName(companyname,issounddex,sounddextype){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/company/companyname`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            companyname : companyname,
            issounddex : issounddex,
            sounddextype : sounddextype
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

function searchRegisteredCapital(registeredcapital){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/search/company/registeredcapital`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          registeredcapital : registeredcapital
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


function searchProjectNumber(projectnumber){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/search/company/projectnumber`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          projectnumber : projectnumber
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

export {searchProjectname,searchIsic,searchIndustrygroup,searchCompanyName,searchRegisteredCapital,searchProjectNumber}