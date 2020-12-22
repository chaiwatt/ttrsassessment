

import * as SearchExpert from './searchexpert.js';
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
        // else{
        //     $("#searchdocno_wrapper").attr("hidden",true);
        //     $("#searchcompanyname_wrapper").attr("hidden",true);
        //     $("#searchprojectname_wrapper").attr("hidden",true);
        //     $("#expert_wrapper").attr("hidden",true);
        //     $("#leader_wrapper").attr("hidden",true);
        //     $("#grage_wrapper").attr("hidden",true);
        //     $("#searchyear_wrapper").attr("hidden",true);
        //     $("#searchword_wrapper").attr("hidden",false);
        //     $("#searchindustrygroup_wrapper").attr("hidden",true);
        //     $("#searchdate_wrapper").attr("hidden",true);
        // }
    // }else{
    //     $("#expert_wrapper").attr("hidden",false);
    //     $("#leader_wrapper").attr("hidden",true);
    //     $("#grade_wrapper").attr("hidden",true);
    //     $("#searchyear_wrapper").attr("hidden",true);
    //     $("#searchword_wrapper").attr("hidden",true);
    //     $("#searchindustrygroup_wrapper").attr("hidden",true);
    //     $("#searchdate_wrapper").attr("hidden",false);
    //     $("#searchword").val('');
    // }
});

// $('#searchdate').bootstrapMaterialDatePicker({
//     format: 'DD/MM/YYYY HH:mm',
//     clearButton: true,
//     cancelText: "ยกเลิก",
//     okText: "ตกลง",
//     clearText: "เคลียร์",
//     time: false
// });
$(document).on('change', '#searchexpertbranch', function(e) {
    SearchExpert.searchBranch($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchprojectname', function(e) {
    SearchExpert.searchProjectname($(this).find("option:selected").text()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchprojectstatus', function(e) {
    SearchExpert.searchProjectstatus($(this).val()).then(data => {
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
    data.forEach(function (expert,index) {
        html += `<tr >  
            <td> ${expert.name} ${expert.lastname}</td>                                                          
            <td> xxx </td>                         
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


