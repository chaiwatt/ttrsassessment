

$(document).on('change', '#searchgroup', function(e) {
    console.log($(this).val());
    // if($(this).val() < 12){
        if($(this).val() == 1){
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",false);
            $("#searchword_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchdate_wrapper").attr("hidden",true);
            $("#searchdate").val('');
        }else if($(this).val() == 5){
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",false);
            $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            // $("#searchdate").val('');
        }else if($(this).val() == 6){
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",false);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            // $("#searchdate").val('');
        }else if($(this).val() == 7){
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",false);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            // $("#searchdate").val('');
        }else if($(this).val() == 8){
            $("#expert_wrapper").attr("hidden",false);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchdate_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",true);
            // $("#searchdate").val('');
        }else{
            $("#expert_wrapper").attr("hidden",true);
            $("#leader_wrapper").attr("hidden",true);
            $("#grage_wrapper").attr("hidden",true);
            $("#searchyear_wrapper").attr("hidden",true);
            $("#searchword_wrapper").attr("hidden",false);
            $("#searchindustrygroup_wrapper").attr("hidden",true);
            $("#searchdate_wrapper").attr("hidden",true);
            // $("#searchdate").val('');
        }
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
    search($('#searchgroup').val(),$(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});
$(document).on('change', '#searchindustrygroup', function(e) {
    console.log($(this).val());
    search($('#searchgroup').val(),$(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

$(document).on('change', '#searchdate', function(e) {
    search($('#searchgroup').val(),$(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});
$(document).on('keyup', '#searchword', function(e) {
    console.log($(this).val());
    search($('#searchgroup').val(),$(this).val()).then(data => {
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
            <td> ${fulltbp.updatedatth} </td>                            
            <td> ${fulltbp.minitbp['project']} </td>                         
            <td> ${fulltbp.minitbp.businessplan.company['name']} </td> 
            <td> ${fulltbp.minitbp.businessplan.businessplanstatus['name']} </td> 
            <td> 
                <a href="${route.url}/dashboard/admin/report/search/view/${fulltbp.id}" class="badge bg-primary">รายละเอียด</a> 
                <a href="${route.url}/dashboard/admin/report/search/pdf/${fulltbp.id}" class="badge bg-teal">PDF</a> 
                <a href="${route.url}/dashboard/admin/report/search/excel/${fulltbp.id}" class="badge bg-info">EXCEL</a> 
            </td> 
        </tr>`
        });
     $("#reportsearch_wrapper").html(html);
}

$(document).on('change', '#searchdate', function(e) {
    search($('#searchgroup').val(),$(this).val()).then(data => {
        createTable(data);
    })
    .catch(error => {})
});

