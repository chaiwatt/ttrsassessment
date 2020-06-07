function sendSMS(phone){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/sms/send`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            phone : phone
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
function saveOTP(otp,inp){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/sms/saveotp`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            inp : inp,
            otp : otp,
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

export {sendSMS,saveOTP}