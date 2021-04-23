$(document).on('click', '.pendinguser', function(e) {
    showPendingUser($(this).data('id')).then(data => {
        var html =``;
        data.forEach(function (user,index) {
            html += `<tr > 
                <td> ${user.name} ${user.lastname}</td>                                                                                    
                </tr>`
            });
        $("#pending_user_modal_wrapper_tr").html(html);
        $('#modal_pending_user').modal('show');
    }).catch(error => {})
});

function showPendingUser(id){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/pendinguser`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            id : id
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