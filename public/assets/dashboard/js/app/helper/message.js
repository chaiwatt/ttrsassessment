function getMessage(messageid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/message/getmessage`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            messageid : messageid
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

export {getMessage}