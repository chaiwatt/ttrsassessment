

import * as SearchProject from './searchproject.js';
import * as Company from './company.js'

$(document).on('change', '#searchgroup', function(e) {
    // if($(this).val() < 12){
        var selectedtedtext = $(this).find("option:selected").text();
        if(selectedtedtext == 'ปีของโครงการ'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",false);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchdate").val('');
        }else if(selectedtedtext == 'เลขที่โครงการ/Mini TBP/Full TBP'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",false);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ชื่อโครงการ'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",false);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'รหัส ISIC'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",false);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'กลุ่มอุตสาหกรรม'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",false);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'เกรด'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",false);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'Leader'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",false);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ผู้เชี่ยวชาญ'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",false);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ชื่อบริษัท'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",false);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ทุนจดทะเบียน'){
            $("#registeredcapital_wrapper").attr("hidden",false);
            $("#searchdocno_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
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
$(document).on('change', '#searchyear', function(e) {
    SearchProject.searchYear($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('keyup', '#searchprojectname', function(e) {
    SearchProject.searchProjectname($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('keyup', '#searchcompanyname', function(e) {
    SearchProject.searchCompanyName($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('keyup', '#searchdocno', function(e) {
    SearchProject.searchDocno($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchisic', function(e) {
    SearchProject.searchIsic($('#isic').val(),$(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchindustrygroup', function(e) {
    SearchProject.searchIndustrygroup($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchleader', function(e) {
    SearchProject.searchLeader($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchexpert', function(e) {
    SearchProject.searchExpert($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchgrade', function(e) {
    SearchProject.searchGrade($(this).find("option:selected").text()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});
$(document).on('change', '#searchregisteredcapital', function(e) {
    SearchProject.searchRegisteredCapital($(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

function search(searchid,value){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/report/search/getsearch`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            searchid : searchid,
            value : value,
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

function createTable(data){
    var html ='';
    data.forEach(function (fulltbp,index) {
        html += `<tr >                                                           
            <td>  
                <a href="${route.url}/dashboard/admin/report/detail/view/${fulltbp.minitbp.businessplan.company['id']}" class="text-info" target="_blank">${fulltbp.minitbp['project']}</a> 
            </td>                         
            <td> 
                <a href="${route.url}/dashboard/admin/search/company/profile/${fulltbp.minitbp.businessplan.company['id']}" class="text-info" target="_blank">${fulltbp.minitbp.businessplan.company['name']} </a> 
            </td> 
            <td>
                <span class="badge badge-flat border-success text-success-600">${fulltbp.minitbp.businessplan.businessplanstatus['name']}</span> 
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


