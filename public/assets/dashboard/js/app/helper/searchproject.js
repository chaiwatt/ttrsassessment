function searchYear(year){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/year`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            year : year
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

function searchDocno(docno){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/docno`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            docno : docno
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

function searchProjectname(projectname,issounddex,sounddextype){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/projectname`,
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
          url: `${route.url}/api/search/project/isic`,
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
          url: `${route.url}/api/search/project/industrygroup`,
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

function searchGrade(grade){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/grade`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            grade : grade
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

function searchLeader(leader){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/leader`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            leader : leader
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

function searchExpert(expert){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/expert`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            expert : expert
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
          url: `${route.url}/api/search/project/companyname`,
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

function searchText(text){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/search/project/text`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            text : text
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
        url: `${route.url}/api/search/project/registeredcapital`,
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

export {searchYear,searchDocno,searchProjectname,searchIsic,searchIndustrygroup,searchGrade,searchLeader,searchExpert,searchCompanyName,searchRegisteredCapital,searchText}