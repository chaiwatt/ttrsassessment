function getEvent(email){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/calendar/google/getevent`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              email : email
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

export {getEvent}