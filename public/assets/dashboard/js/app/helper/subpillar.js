function getSubPillar(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getsubpillar`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

  function getSubPillarIndex(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getsubpillarindex`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

  function getCriteria(evid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/getcriteria`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            value: value
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

  function deleteSubPillar(evid,pillarid,subpillarid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/deletesubpillar`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            pillarid : pillarid,
            subpillarid : subpillarid
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

  function deleteSubPillarIndex(evid,pillarid,subpillarid,subpillarindexid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/deletesubpillarindex`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid : evid,
            pillarid : pillarid,
            subpillarid : subpillarid,
            subpillarindexid : subpillarindexid
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

  function addSubPillar(evid,pillar,subpillar){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/addsubpillar`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            pillar: pillar,
            value: subpillar
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

  function addSubPillarIndex(evid,subpillar,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/addsubpillarindex`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            subpillar: subpillar,
            value: value
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

  function addCriteria(evid,subpillarindex,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/ev/subpillar/addcriteria`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            evid: evid,
            subpillarindex: subpillarindex,
            value: value
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

export {getSubPillar,getSubPillarIndex,getCriteria,deleteSubPillar,deleteSubPillarIndex,addSubPillar,addSubPillarIndex,addCriteria}