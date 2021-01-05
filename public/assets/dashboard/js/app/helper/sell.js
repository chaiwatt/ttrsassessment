function addSell(id,name,present,past1,past2,past3){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/sell/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id,
            'name': name,
            'present': present,
            'past1': past1,
            'past2': past2,
            'past3': past3
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

function deleteSell(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/sell/delete`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id
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

function getSell(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/sell/get`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id
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

function editSell(id,name,present,past1,past2,past3){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/fulltbp/sell/edit`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id,
            'name': name,
            'present': present,
            'past1': past1,
            'past2': past2,
            'past3': past3
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


function getSellStatus(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/sellstatus/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editSellStatus(id,present,past1,past2,past3){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/sellstatus/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'present': present,
          'past1': past1,
          'past2': past2,
          'past3': past3
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

function addDebtPartner(id,debtpartner,numproject,partnertaxid,totalyearsell,percenttosale,businessyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/debtpartner/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'debtpartner': debtpartner,
          'numproject': numproject,
          'partnertaxid': partnertaxid,
          'totalyearsell': totalyearsell,
          'percenttosale': percenttosale,
          'businessyear': businessyear
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

function getDebtPartner(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/debtpartner/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editDebtPartner(id,debtpartner,numproject,partnertaxid,totalyearsell,percenttosale,businessyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/debtpartner/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'debtpartner': debtpartner,
          'numproject': numproject,
          'partnertaxid': partnertaxid,
          'totalyearsell': totalyearsell,
          'percenttosale': percenttosale,
          'businessyear': businessyear
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

function deleteDebtPartner(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/debtpartner/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function addCreditPartner(id,creditpartner,partnertaxid,totalyearpurchase,percenttopurchase,businessyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/creditpartner/add`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'creditpartner': creditpartner,
          'partnertaxid': partnertaxid,
          'totalyearpurchase': totalyearpurchase,
          'percenttopurchase': percenttopurchase,
          'businessyear': businessyear
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

function getCreditPartner(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/creditpartner/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editCreditPartner(id,creditpartner,partnertaxid,totalyearpurchase,percenttopurchase,businessyear){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/creditpartner/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'creditpartner': creditpartner,
          'partnertaxid': partnertaxid,
          'totalyearpurchase': totalyearpurchase,
          'percenttopurchase': percenttopurchase,
          'businessyear': businessyear
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

function deleteCreditPartner(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/creditpartner/delete`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function getAsset(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/asset/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editAsset(id,assetcostedit,assetquantityedit,assetpriceedit,assetspecificationedit){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/asset/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'assetcostedit': assetcostedit,
          'assetquantityedit': assetquantityedit,
          'assetpriceedit': assetpriceedit,
          'assetspecificationedit': assetspecificationedit
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

function getInvestment(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/investment/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editInvestment(id,investment){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/investment/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'investment': investment
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

function getCost(id){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/cost/get`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id
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

function editCost(id,existing,need,approved,plan){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/cost/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'existing': existing,
          'need': need,
          'approved': approved,
          'plan': plan
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

function editROI(id,income,profit,reduce,directors){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/fulltbp/roi/edit`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'income': income,
          'profit': profit,
          'reduce': reduce,
          'directors': directors
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


export {addSell,deleteSell,getSell,editSell,getSellStatus,editSellStatus,addDebtPartner,getDebtPartner,editDebtPartner,deleteDebtPartner
,addCreditPartner,getCreditPartner,editCreditPartner,deleteCreditPartner,getAsset,editAsset,getInvestment,editInvestment,getCost,editCost,editROI}