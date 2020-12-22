

import * as SearchOfficer from './searchofficer.js';
import * as Company from './company.js'

$(document).on('change', '#searchgroup', function(e) {
    
    // if($(this).val() < 12){
        var selectedtedtext = $(this).find("option:selected").text();
        console.log(selectedtedtext);
        if(selectedtedtext == 'สาขาความเชี่ยวชาญ'){
            $("#searchexpertbranch_wrapper").attr("hidden",false);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#projectstatus_wrapper").attr("hidden",true);
            searchprojectstatus
        }else if(selectedtedtext == 'ชื่อโครงการ'){
            $("#searchexpertbranch_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",false);
            $("#projectstatus_wrapper").attr("hidden",true);
        }if(selectedtedtext == 'สถานะโครงการ'){
            $("#searchexpertbranch_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#projectstatus_wrapper").attr("hidden",false);
        }
});

$(document).on('change', '#searchexpertbranch', function(e) {
    console.log($(this).val());
    SearchOfficer.searchBranch($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('keyup', '#searchprojectname', function(e) {
    SearchOfficer.searchProjectname($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchprojectstatus', function(e) {
    SearchOfficer.searchProjectstatus($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

// $(document).on('click', '#btnsearch', function(e) {
//     console.log($('#searchgroup').val());
//     // search($('#searchgroup').val(),$(this).val()).then(data => {
//     //     createTable(data);
//     // }).catch(error => {});
// });


function createTable(data){
    var html ='';
    data.forEach(function (officer,index) {
        html += `<tr >  
            <td> ${officer.name} ${officer.lastname}</td>                                                          
            <td> xxx </td>                         
            <td>
                yyy
            </td> 
        </tr>`
        });
     $("#reportsearch_wrapper").html(html);
}

$(document).on('change', '#isic', function(e) {
    Company.getSubIsic($(this).val()).then(data => {
        var html = `<option value="000" >เลือกรายการ</option>`;
        data.subisics.forEach(function (subisic,index) {
            html +=`<option value="${subisic['id']}" >${subisic['name']}</option>`
            });
         $("#searchisic").html(html);
    })
    .catch(error => {})
});


