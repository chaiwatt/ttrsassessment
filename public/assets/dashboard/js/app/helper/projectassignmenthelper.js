import * as WorkLoad from './workload.js'

$(".leader").on('click', function() {
    var waschecked = $(this).data('checked');
    if( waschecked ) {
        $(this).prop('checked', false);
    }
    $(this).data('checked', !waschecked)
   
    $(':radio[name=' + this.name + ']').not(this).data('checked', false);
    if($(this).is(":checked") == true){
        $("#main_wrapper").attr("hidden",false);
        var html = '';
        WorkLoad.getWorkLoadLeader($(this).val()).then(data => {
            data.allprojects.forEach(function (fulltbp,index) {
                var status = fulltbp.minitbp.businessplan.businessplanstatus['name'];
                if(fulltbp.minitbp.businessplan.finished == '1'){
                    status = "ปิดโครงการ";
                }
                var fulltbpcode = fulltbp.fulltbp_code;
                if(fulltbpcode == null){
                    fulltbpcode = '';
                }
                html += `<tr >                                        
                    <td style='text-align:center'> ${fulltbpcode} </td>                            
                    <td> ${fulltbp.minitbp['project']} </td>                         
                    <td> ${fulltbp.minitbp.businessplan.company['fullname']} </td> 
                    <td> ${status} </td> 
                </tr>`
                });
             $("#fulltbp_wrapper_tr").html(html);
            // $("#total").html(data.allprojects.length);
            // $("#finished").html(data.finishedprojects.length);
            // $("#pending").html(data.allprojects.length-data.finishedprojects.length);
       })
       .catch(error => {})
    }else{
        $("#main_wrapper").attr("hidden",true);
    }
});

$(".coleader").on('click', function() {
    var waschecked = $(this).data('checked');
    if( waschecked ) {
        $(this).prop('checked', false);
    }
    $(this).data('checked', !waschecked)
   
    $(':radio[name=' + this.name + ']').not(this).data('checked', false);
    if($(this).is(":checked") == true){
        $("#main_wrapper").attr("hidden",false);
        var html = '';
        WorkLoad.getWorkLoadCoLeader($(this).val()).then(data => {
            data.allprojects.forEach(function (fulltbp,index) {
                var status = fulltbp.minitbp.businessplan.businessplanstatus['name'];
                if(fulltbp.minitbp.businessplan.finished == '1'){
                    status = "ปิดโครงการ";
                }
                html += `<tr >                                        
                    <td> ${fulltbp.updatedatth} </td>                            
                    <td> ${fulltbp.minitbp['project']} </td>                         
                    <td> ${fulltbp.minitbp.businessplan.company['fullname']} </td> 
                    <td> ${status} </td> 
                </tr>`
                });
             $("#fulltbp_wrapper_tr").html(html);
            $("#total").html(data.allprojects.length);
            $("#finished").html(data.finishedprojects.length);
            $("#pending").html(data.allprojects.length-data.finishedprojects.length);
       })
       .catch(error => {})
    }else{
        $("#main_wrapper").attr("hidden",true);
    }
});