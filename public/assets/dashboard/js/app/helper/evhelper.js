
import * as Pillar from './pillar.js';
import * as SubPillar from './subpillar.js';
import * as SubPillarIndex from './subpillarindex.js';

$(document).on('click', '#btnaddclustergroup', function(e) {
    Pillar.getPillar().then(data => {
        var html ='<option value="0" >==เลือกรายการ==</option>';
        console.log(data);
        data.forEach(function (pilla,index) {
                html += `<option value="${pilla['id']}" >${pilla['name']}</option>`
            });
         $("#pillar").html(html);
        //  $("#pillar option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
         $('#modal_add_clustergroup').modal('show');
    })
    .catch(error => {})
});

$(document).on('change', '#pillar', function(e) {
    console.log($(this).val());
    var html ='<option value="0" >==เลือกรายการ==</option>';
    SubPillar.getSubPillar($('#evid').val(),$(this).val()).then(data => {
        data.forEach(function (ev,index) {
                html += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
        $("#subpillar").html(html);
        $("#subpillar option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    }).catch(error => {})
});

$(document).on('change', '#subpillar', function(e) {
    SubPillar.getSubPillarIndex($('#evid').val(),$(this).val()).then(data => {
        var html ='<option value="0" >==เลือกรายการ==</option>';
        console.log(data);
        var html0 ='';
        var html1 ='';
        data.subpillarindexs.forEach(function (subpillar,index) {
                html0 += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
            });
        data.indextypes.forEach(function (indextype,index) {
                html1 += `<option value="${indextype['id']}" >${indextype['name']}</option>`
            });
        $("#subpillarindex").html(html0);
        $("#indextype").html(html1);
        $("#subpillarindex option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    }).catch(error => {})
});

$(document).on('change', '#subpillarindex', function(e) {
    SubPillar.getCriteria($('#evid').val(),$(this).val()).then(data => {
        var html ='';
        data.forEach(function (subpillar,index) {
                html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
            });
        $("#criteria").html(html);
        $("#criteria option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    }).catch(error => {})
});