function updateJoinEvent(id,state) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/calendar/updatejoinevent`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                id : id,
                state : state
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

export {updateJoinEvent}