

function addEvCheckList(evid,indextype,subpillarindex,criterias,gradea,gradeb,gradec,graded,gradee,gradef){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/addevchecklist`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            indextype : indextype,
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

function addEvGrading(evid,indextype,subpillarindex){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/addevgrading`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            indextype : indextype,
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

export {addEvCheckList,addEvGrading}