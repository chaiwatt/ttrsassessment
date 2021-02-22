
import * as Cluster from './cluster.js';
import * as SubCluster from './subcluster.js';
import * as Extrafactor from './extrafactor.js';
import * as SubExtrafactor from './subextrafactor.js';
import * as ClusterTransaction from './clustertransaction.js';



$(document).on('click', '#btnaddclustergroup', function(e) {
    Cluster.getCluster().then(data => {
        var html = ``;
        console.log(data);
        data.forEach(function (cluster,index) {
                html += `<option value="${cluster['id']}" >${cluster['name']}</option>`
            });
         $("#cluster").html(html);
         $('#modal_add_clustergroup').modal('show');
    })
    .catch(error => {})
});

$("#cluster").on('change', function() {
    SubCluster.getSubCluster($(this).val()).then(data => {
        $("#subcluster_wrapper").attr("hidden",false);
        var html = ``;
        console.log(data);
        if(data.length > 0){
            $("#subcluster_wrapper").attr("hidden",false);
        }else{
            $("#subcluster_wrapper").attr("hidden",true);
            $("#extrafactor_wrapper").attr("hidden",true);
            $("#subextrafactor_wrapper").attr("hidden",true);
        }
        data.forEach(function (cluster,index) {
                html += `<option value="${cluster['id']}" >${cluster['name']}</option>`
            });
        $("#subcluster").html(html);
    })
    .catch(error => {})
});

$("#subcluster").on('change', function() {
    console.log($(this).val());
    Extrafactor.getExtraFactor($(this).val()).then(data => {
        $("#extrafactor_wrapper").attr("hidden",false);
        var html = ``;
        console.log(data);
        if(data.length > 0){
            $("#extrafactor_wrapper").attr("hidden",false);
        }else{
            $("#extrafactor_wrapper").attr("hidden",true);
            // $("#subextrafactor_wrapper").attr("hidden",true);
        }
        data.forEach(function (cluster,index) {
                html += `<option value="${cluster['id']}" >${cluster['name']}</option>`
            });
        $("#extrafactor").html(html);
    })
    .catch(error => {})
});


$("#extrafactor").on('change', function() {
    var output = "<div class='row'>";
    var html = ``;
    for(var k = 0;k<$(this).val().length;k++){
           output += `<div class='col-md-4'><div class="form-group">
                        <input type="text" name="extrafactorscore[]" id="extrafactor_score" data-id="${$(this).val()[k]}" class="form-control form-control-lg" placeholder="${$("#extrafactor option[value='"+$(this).val()[k]+"']").text()} score">
                      </div></div>`;
       
        SubExtrafactor.getSubExtraFactor($(this).val()[k]).then(data => {
            console.log('data');
            $("#subextrafactor_wrapper").attr("hidden",false);
            if(data.subextrafactors.length > 0){
                
                data.subextrafactors.forEach(function (subextrafactor,index) {
                    html += `<option data-id="${data.extrafactor['id']}" value="${subextrafactor['id']}-${data.extrafactor['id']}" >${subextrafactor['name']}</option>`;
                })
                
                $("#subextrafactor").html(html);
                // $('.form-control-select2').select2();  
            }
           
        }).catch(error => {});   
    }
    
    output += "</div>";
    output = output.replace(`<div class='row'></div>`, ``);
    console.log(html);
    $("#extrafactor2_wrapper").html(output);
});


$(document).on('change', '#subextrafactor', function(e) {
    console.log('extrafactor: ' + $(this).val().length);
    
    var output = "<div class='row'>";
    for(var k = 0;k<$(this).val().length;k++){
        var array = $(this).val()[k].split('-');
        // console.log($(this).val()[k]);
        output += `<div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="subextrafactorscore[]" id="subextrafactor_score" data-extrafactor="${array[1]}" data-id="${array[0]}" class="form-control form-control-lg" placeholder="${$("#subextrafactor option[value='"+$(this).val()[k]+"']").text()} score">
                        </div>
                    </div>`;
    }
    
    output += "</div>";
    $("#subextrafactor2_wrapper").html(output);
});

$(document).on('click', '#btn_modal_add_clustergroup', function(e) {
    var subextrafactorscore = [];
    $('input[name^="subextrafactorscore"]').each(function() {
        console.log($(this).data('extrafactor') + ' ' + $(this).data('id'));
        subextrafactorscore.push({
            subcluster: $('#subcluster').val(),
            extrafactor: $(this).data('extrafactor'),
            subextrafactorscore: $(this).data('id'),
            score: $(this).val(),
        });
    });
    var extrafactorscore = [];
    $('input[name^="extrafactorscore"]').each(function() {
        extrafactorscore.push({
            subcluster: $('#subcluster').val(),
            extrafactor: $(this).data('id'),
            score: $(this).val(),
        });
    });
    // return ;

    // console.log($('#assessmentgroupid').val() + ' ' + $('#cluster').val() + ' ' + $('#subcluster').val() + ' ' + $('#subclusterweight').val() + ' ' + $('#extrafactor').val() + ' ' + $('#extrafactorscore').val() + ' ' + $('#subextrafactor').val() + ' ' + $('#subextrafactorscore').val());
    ClusterTransaction.addClusterTransaction($('#assessmentgroupid').val(),$('#cluster').val(),$('#subcluster').val(),$('#subclusterweight').val(),$('#extrafactor').val(),$('#extrafactorscore').val(),$('#subextrafactor').val(),$('#subextrafactorscore').val(),subextrafactorscore,extrafactorscore).then(data => {
        var html = ``;
        console.log(data);
        data.forEach(function (transaction,index) {
            html += `<tr >                                        
            <td> ${transaction.cluster_id} </td>                                            
            <td> ${transaction.sub_cluster_id} (${transaction.sub_cluster_weight})</td> 
            <td> ${transaction.extrafactor_id} (${transaction.extrafactor_score})</td>                                            
            <td> ${transaction.sub_extrafactor_id} (${transaction.sub_extrafactor_score})</td> 
            <td> <a type="button" data-id="${transaction.id}" class="btn badge bg-danger edittransaction">ลบ</a> </td> 
        </tr>`
            });
         $("#cluster_transaction_wrapper_tr").html(html);
         $('#modal_add_clustergroup').modal('hide');
    })
    .catch(error => {})
});