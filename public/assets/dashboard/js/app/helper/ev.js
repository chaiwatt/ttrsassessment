

function addEvCheckList(evid,indextype,pillar,subpillar,subpillarindex,criterias,gradea,gradeb,gradec,graded,gradee,gradef){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/addevchecklist`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            indextype : indextype,
            pillar : pillar,
            subpillar : subpillar,
            subpillarindex : subpillarindex,
            criterias : criterias,
            gradea : gradea,
            gradeb : gradeb,
            gradec : gradec,
            graded : graded,
            gradee : gradee,
            gradef : gradef
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

function addEvGrading(evid,indextype,pillar,subpillar,subpillarindex){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/addevgrading`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            indextype : indextype,
            pillar : pillar,
            subpillar : subpillar,
            subpillarindex : subpillarindex
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

function getEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/getev`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid
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

function getEvByFullTbp(fulltbpid){
  return new Promise((resolve, reject) => {
      $.ajax({
      url: `${route.url}/api/assessment/ev/getevbyfulltbp`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          fulltbpid : fulltbpid
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

function copyEv(orgevid,newevid){
  return new Promise((resolve, reject) => {
      $.ajax({
      url: `${route.url}/api/assessment/ev/copyev`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          orgevid : orgevid,
          newevid : newevid
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

function updateEvStatus(id,chkevstatus){
  return new Promise((resolve, reject) => {
      $.ajax({
      url: `${route.url}/api/assessment/ev/updateevstatus`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
          id : id,
          chkevstatus : chkevstatus
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

function getEvCheckList(pillar,subpillar,subpillarindex){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/assessment/ev/getevchecklist`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          pillar : pillar,
          subpillar : subpillar,
          subpillarindex : subpillarindex
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

function editEv(evid,name,version,percentindex,percentextra){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/assessment/ev/editev`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          evid : evid,
          name : name,
          version : version,
          percentindex : percentindex,
          percentextra : percentextra
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

export {addEvCheckList,addEvGrading,getEv,getEvByFullTbp,copyEv,updateEvStatus,getEvCheckList,editEv}