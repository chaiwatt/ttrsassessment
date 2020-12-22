

import * as SearchProject from './searchproject.js';
import * as Company from './company.js'

$(document).on('change', '#searchgroup', function(e) {
    
    // if($(this).val() < 12){
        var selectedtedtext = $(this).find("option:selected").text();
        console.log(selectedtedtext);
        if(selectedtedtext == 'ชื่อโครงการ'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",false);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'รหัส ISIC'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",false);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'กลุ่มอุตสาหกรรม'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",false);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ชื่อบริษัท'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",false);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
        }else if(selectedtedtext == 'ทุนจดทะเบียน'){
            $("#isic_wrapper").attr("hidden",true);
            $("#registeredcapital_wrapper").attr("hidden",false);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
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
    // console.log($(this).val());
    SearchProject.searchRegisteredCapital($(this).val()).then(data => {
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
            <a  href="${route.url}/dashboard/admin/search/company/profile/${fulltbp.minitbp.businessplan.company['id']}" class="text-info" target="_blank">${fulltbp.minitbp.businessplan.company['name']}</a> 
            </td>                                                          
            <td> ${fulltbp.minitbp['project']} </td>                         
            <td>
                ${fulltbp.minitbp.businessplan.company['registeredcapital'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')} 
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


