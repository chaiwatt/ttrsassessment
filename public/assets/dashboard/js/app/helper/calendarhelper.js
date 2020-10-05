
import * as Calendar from './calendar.js';

$(document).on('change', '#fulltbp', function(e) {
    var html ='';
    Calendar.getParticipate($(this).val()).then(data => {
        data.forEach(function (participate,index) {
            html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
        });
        $("#user").html(html);
    }).catch(error => {})
});