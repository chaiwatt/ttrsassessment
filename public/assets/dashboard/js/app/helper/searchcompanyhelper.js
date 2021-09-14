

import * as SearchProject from './searchproject.js';
import * as Company from './company.js'
var sounddextype = 1;
$(document).on('change', '#searchgroup', function(e) {
    
    // if($(this).val() < 12){
        var selectedtedtext = $(this).find("option:selected").text();
        if(selectedtedtext == 'ชื่อโครงการ'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",false);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#soundex_wrapper").attr("hidden",false);
            $("#soundex_res").html('');
        }else if(selectedtedtext == 'รหัส ISIC'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",false);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
        }else if(selectedtedtext == 'กลุ่มอุตสาหกรรม'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",false);
            $("#searchword_wrapper").attr("hidden",true);
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
        }else if(selectedtedtext == 'ชื่อบริษัท'){
            $("#registeredcapital_wrapper").attr("hidden",true);
            $("#isic_wrapper").attr("hidden",true);
            $("#searchcompanyname_wrapper").attr("hidden",false);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#soundex_wrapper").attr("hidden",false);
            $("#soundex_res").html('');
        }else if(selectedtedtext == 'ทุนจดทะเบียน'){
            $("#isic_wrapper").attr("hidden",true);
            $("#registeredcapital_wrapper").attr("hidden",false);
            $("#searchcompanyname_wrapper").attr("hidden",true);
            $("#searchprojectname_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
        }

});

// $(document).on('change', '#searchyear', function(e) {
//     SearchProject.searchYear($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('keyup', '#searchprojectname', function(e) {
//     SearchProject.searchProjectname($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('keyup', '#searchdocno', function(e) {
//     SearchProject.searchDocno($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('change', '#searchleader', function(e) {
//     SearchProject.searchLeader($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('change', '#searchexpert', function(e) {
//     SearchProject.searchExpert($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('change', '#searchgrade', function(e) {
//     SearchProject.searchGrade($(this).find("option:selected").text()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
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
    console.log(data);
    var html ='';
    data.companies.forEach(function (company,index) {
        var companyname = company['fullname'];
        var html_minitbp ='';
        if(company.minitbpbelong.length > 0){
            html_minitbp +=`<ul>`;
            company.minitbpbelong.forEach(function (minitbp,index) {
                html_minitbp +=`<li><a href="${route.url}/dashboard/admin/report/detail/view/${minitbp.businessplan['id']}" class="text-info" target="_blank">${minitbp['project']}</a></li>`;
            }); 
            html_minitbp +=`</ul>`;
        }
        html += `<tr >  
        <td style="text-align:center;width:10%">${index+1}</td>
            <td style="width:40%"> 
            <a  href="${route.url}/dashboard/admin/search/company/profile/${company['id']}" class="text-info" target="_blank">${companyname}</a> 
            </td>                                                          
            <td style="width:50%">
           ${html_minitbp}
            </td>                         
        </tr>`
        });
     $("#reportsearch_wrapper").html(html);
}

$(document).on('click', '#btnsearch', function(e) {
    var selectedtedtext = $('#searchgroup').find("option:selected").text();
    if(selectedtedtext == 'ชื่อโครงการ'){
        $("#soundex_res").html('');
        var issounddex = $('#sounddex').is(':checked');
        SearchProject.searchProjectname($('#searchprojectname').val(),issounddex,sounddextype).then(data => {
            createTable(data);
            if(data.soundex.length > 0){
                var text = "ค้นหาจากคำใกล้เคียง ";
                data.soundex.forEach(function (_soundex,index) {
                    text += _soundex['word'] + " ";
                });
                $("#soundex_res").append(text);
            }
        })
        .catch(error => {})
    }  

    if(selectedtedtext == 'ชื่อบริษัท'){
        $("#soundex_res").html('');
        var issounddex = $('#sounddex').is(':checked');
        SearchProject.searchCompanyName($('#searchcompanyname').val(),issounddex,sounddextype).then(data => {
            createTable(data);
            if(data.soundex.length > 0){
                var text = "ค้นหาจากคำใกล้เคียง ";
                data.soundex.forEach(function (_soundex,index) {
                    text += _soundex['word'] + " ";
                });
                $("#soundex_res").append(text);
            }
        })
        .catch(error => {})
    }  

    if(selectedtedtext == 'ทุนจดทะเบียน'){
        $("#soundex_res").html('');
        SearchProject.searchRegisteredCapital($('#searchregisteredcapital').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

    if(selectedtedtext == 'รหัส ISIC'){
        $("#soundex_res").html('');
        SearchProject.searchIsic($('#isic').val(),$('#searchisic').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

    if(selectedtedtext == 'กลุ่มอุตสาหกรรม'){
        $("#soundex_res").html('');
        SearchProject.searchIndustrygroup($('#searchindustrygroup').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

});

// $(document).on('keyup', '#searchprojectname', function(e) {
//     SearchProject.searchProjectname($(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });