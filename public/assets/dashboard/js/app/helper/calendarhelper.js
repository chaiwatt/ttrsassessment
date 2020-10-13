
import * as Calendar from './calendar.js';

$(function() {
    // console.log( "ready!" );
    // fulltbp
    Participate($('#fulltbp').val());
});

$(document).on('change', '#fulltbp', function(e) {
    // var html ='';
    // Calendar.getParticipate($(this).val()).then(data => {
    //     data.forEach(function (participate,index) {
    //         html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
    //     });
    //     $("#user").html(html);
    // }).catch(error => {})
    Participate($(this).val());
});


function Participate(id){
    var html ='';
    Calendar.getParticipate(id).then(data => {
        data.forEach(function (participate,index) {
            html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
        });
        $("#user").html(html);
    }).catch(error => {})
}