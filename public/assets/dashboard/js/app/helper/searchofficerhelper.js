

import * as SearchOfficer from './searchofficer.js';
import * as Company from './company.js'

$(document).on('change', '#searchgroup', function(e) {
    
    // if($(this).val() < 12){
        var selectedtedtext = $(this).find("option:selected").text();
        if(selectedtedtext == 'สาขาความเชี่ยวชาญ'){
            $("#searchname_wrapper").attr("hidden",true);
            $("#searchexpertbranch_wrapper").attr("hidden",false);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#projectstatus_wrapper").attr("hidden",true);
            searchprojectstatus
        }else if(selectedtedtext == 'ชื่อโครงการ'){
            $("#searchname_wrapper").attr("hidden",true);
            $("#searchexpertbranch_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",false);
            $("#projectstatus_wrapper").attr("hidden",true);
        }if(selectedtedtext == 'สถานะโครงการ'){
            $("#searchname_wrapper").attr("hidden",true);
            $("#searchexpertbranch_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#projectstatus_wrapper").attr("hidden",false);
        }if(selectedtedtext == 'ชื่อ-นามสกุล'){
            $("#searchname_wrapper").attr("hidden",false);
            $("#searchexpertbranch_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#projectstatus_wrapper").attr("hidden",true);
        }
});

$(document).on('keyup', '#searchname', function(e) {
    SearchOfficer.searchName($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchexpertbranch', function(e) {
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


function createTable(data){
    var html ='';
    data.forEach(function (officer,index) {
        var td ='';
        officer['fulltbpofficer'].forEach(function (fulltbp,item) {
            var color = 'bg-grey-300';
            var status = 'กำลังดำเนินการ';
            if(fulltbp.status == 3){
                color = "bg-success-400";
                status = "เสร็จสิ้น";
            }
            td += `
            <li>
                <i class="icon-primitive-dot mr-2"></i>
                <a href="${route.url}/dashboard/admin/report/detail/view/${fulltbp.minitbp.businessplan['id']}" class="text-info" target="_blank">${fulltbp.minitbp['project']}</a> 
                <span class="badge badge-pill ${color} ml-20 ml-md-0">${status}</span>
            </li>
            `
        });
        html += `<tr >  
            <td> 
                <a href="${route.url}/dashboard/admin/search/expert/profile/${officer.id}" class="text-info" target="_blank">${officer.name} ${officer.lastname} </a> 
            </td>                                                          
            <td> 
                <ul class="list list-unstyled mb-0">
                    ${td}
                </ul>
                
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


