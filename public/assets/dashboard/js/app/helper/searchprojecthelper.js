

import * as SearchProject from './searchproject.js';
import * as Company from './company.js'
var sounddextype = 1;
$(document).on('change', '#searchgroup', function(e) {
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
            $("#soundex_wrapper").attr("hidden",true);
            // $("#searchdate_wrapper").attr("hidden",true);
            $("#searchdate").val('');
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",false);
            $("#soundex_res").html('');
            sounddextype = 1;
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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
            $("#soundex_wrapper").attr("hidden",false);
            $("#soundex_res").html('');
            sounddextype = 1;
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
            $("#soundex_wrapper").attr("hidden",true);
            $("#soundex_res").html('');
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

// $(document).on('keyup', '#searchcompanyname', function(e) {
//     SearchProject.searchCompanyName($(this).val()).then(data => {
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

// $(document).on('change', '#searchisic', function(e) {
//     SearchProject.searchIsic($('#isic').val(),$(this).val()).then(data => {
//         createTable(data);
//     })
//     .catch(error => {})
// });

// $(document).on('change', '#searchindustrygroup', function(e) {
//     SearchProject.searchIndustrygroup($(this).val()).then(data => {
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
// $(document).on('change', '#searchregisteredcapital', function(e) {
//     SearchProject.searchRegisteredCapital($(this).val()).then(data => {
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
    var html ='';
    data.forEach(function (fulltbp,index) {
        var code = '';
        if(fulltbp.fulltbp_code != null){
            code = fulltbp.fulltbp_code;
        }
        html += `<tr > 
        <td style="text-align:center">${index +1}</td>     
        <td style="text-align:center">${code}</td>                                                        
            <td>  
                <a href="${route.url}/dashboard/admin/report/detail/view/${fulltbp.minitbp.businessplan['id']}" class="text-info" target="_blank">${fulltbp.minitbp['project']}</a> 
            </td>                         
            <td> 
                <a href="${route.url}/dashboard/admin/search/company/profile/${fulltbp.minitbp.businessplan.company['id']}" class="text-info" target="_blank">${fulltbp.minitbp.businessplan.company['name']} </a> 
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

$(document).on('click', '#btnsearch', function(e) {
    var selectedtedtext = $('#searchgroup').find("option:selected").text();
    if(selectedtedtext == 'ปีของโครงการ'){
        $("#soundex_res").html('');
        SearchProject.searchYear($('#searchyear').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    }

    if(selectedtedtext == 'เลขที่โครงการ/Mini TBP/Full TBP'){
        $("#soundex_res").html('');
        SearchProject.searchDocno($('#searchdocno').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    }    

    if(selectedtedtext == 'ชื่อโครงการ'){
        $("#soundex_res").html('');
        var issounddex = $('#sounddex').is(':checked');
        SearchProject.searchProjectname($('#searchprojectname').val(),issounddex,sounddextype).then(data => {
            createTable(data.fulltbps);
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
    if(selectedtedtext == 'เกรด'){
        $("#soundex_res").html('');
        SearchProject.searchGrade($('#searchgrade').find("option:selected").text()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

    if(selectedtedtext == 'Leader'){
        $("#soundex_res").html('');
        SearchProject.searchLeader($('#searchleader').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

    if(selectedtedtext == 'ผู้เชี่ยวชาญ'){
        $("#soundex_res").html('');
        SearchProject.searchExpert($('#searchexpert').val()).then(data => {
            createTable(data);
        })
        .catch(error => {})
    } 

    if(selectedtedtext == 'ชื่อบริษัท'){
        $("#soundex_res").html('');
        var issounddex = $('#sounddex').is(':checked');
        SearchProject.searchCompanyName($('#searchcompanyname').val(),issounddex,sounddextype).then(data => {
            createTable(data.fulltbps);
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

});

