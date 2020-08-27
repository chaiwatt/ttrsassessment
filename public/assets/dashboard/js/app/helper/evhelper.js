
import * as Pillar from './pillar.js';
import * as SubPillar from './subpillar.js';
import * as SubPillarIndex from './subpillarindex.js';
import * as Ev from './ev.js';

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
        var html0 ='<option value="0" >==เลือกรายการ==</option>';
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
    
    $("#criteria_wrapper").attr("hidden",true);
    SubPillar.getCriteria($('#evid').val(),$(this).val()).then(data => {
        console.log(data);
        var html ='';
        data.forEach(function (subpillar,index) {
                html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
            });
        $("#criteria").html(html);
        $("#criteria option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    }).catch(error => {})
});

$(document).on('change', '#indextype', function(e) {
  if($(this).val() == 1){
    $("#grade_wrapper").attr("hidden",true);
  }else if($(this).val() == 2){
      $("#grade_wrapper").attr("hidden",false);
  }
});

$('.steps-basic').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> กลับ',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: 'เพิ่มรายการ <i class="icon-arrow-right14 ml-2" />'
    },
    autoFocus: true,
    onStepChanging: function (event, currentIndex, newIndex) {
        console.log(newIndex);
        if(newIndex == 1){
            if($('#pillar').val() == 0){
                return false;
            }else{
                return true;
            }  
        }else if(newIndex == 2){
            if($('#subpillar').val() == 0){
                return false;
            }else{
                return true;
            } 
        }else if(newIndex == 3){
            if($('#subpillarindex').val() == 0){
                return false;
            }else{
                $("#criteria_wrapper").attr("hidden",true);
                if($('#indextype').val() == 2){
                    $("#criteria_wrapper").attr("hidden",false);
                    if($('#gradea').val() == '' || $('#gradeb').val() == '' ||$('#gradec').val() == '' ||$('#graded').val() == '' ||$('#gradee').val() == '' ||$('#gradef').val() == ''){
                        return false;
                    }
                }
                return true;
            } 
        }else{
            return true;
        }
        },
    onFinishing: function (event, currentIndex) {
        return true;
        // form.validate().settings.ignore = ':disabled';
        // return form.valid();
    },
    onFinished: function (event, currentIndex) {
        console.log('ok');
        if($('#indextype').val() == 1){
            AddGrading();
        }else{
            AddCheckList();
        }
    }
});

function AddCheckList(){
    console.log('add checklist');
    var criterias = [];
    $("#criteria").each(function(i, sel){
        var selectedVal = $(sel).val();
        criterias =selectedVal;
    });

    Ev.addEvCheckList($('#evid').val(),$('#indextype').val(),$('#subpillarindex').val(),criterias,$('#gradea').val(),$('#gradeb').val(),$('#gradec').val(),$('#graded').val(),$('#gradee').val(),$('#gradef').val()).then(data => {
        console.log(data);
        var html =``;
        data.forEach(function (criteria,index) {
            var criterianame = '-';
            if(criteria.criteria != null){
                criterianame = criteria.criteria['name']
            }
            html += `<tr >                                       
                <td> ${criteria.pillar['name']} </td>                                            
                <td> ${criteria.subpillar['name']} </td>    
                <td> xx </td>  
                <td> ประเภท(check, grading) </td>  
                <td> ${criterianame} </td>                                           
                <td> 
                    <a type="button" data-id="${criteria.id}" class="btn badge bg-warning editcriteriatransaction">แก้ไข</a>  
                </td> 
            </tr>`
            });
         $("#criteria_transaction_wrapper_tr").html(html);
     
         RowSpan();
    }).catch(error => {})
}

function AddGrading(){
    console.log('add grading');
    Ev.addEvGrading($('#evid').val(),$('#indextype').val(),$('#subpillarindex').val()).then(data => {
        console.log(data);
        var html =``;
        

        data.forEach(function (criteria,index) {
            var criterianame = '';
            if(criteria.criteria != null){
                criterianame = criteria.criteria['name']
            }
            html += `<tr > 
                <td> ${criteria.pillar['name']} </td>                                            
                <td> ${criteria.subpillar['name']} </td>   
                <td> xx </td>  
                <td> ประเภท(check, grading) </td>  
                <td> ${criterianame} </td>                                            
                <td> 
                    <a type="button" data-id="${criteria.id}" class="btn badge bg-warning editcriteriatransaction">แก้ไข</a>  
                </td> 
            </tr>`
            });
         $("#criteria_transaction_wrapper_tr").html(html);

         RowSpan();
    }).catch(error => {})
}

function RowSpan(){
    const table = document.querySelector('table');
    let headerCell = null;
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
            headerCell = firstCell;
        } else {
            headerCell.rowSpan++;
            firstCell.remove();
        }
    }
    table = document.querySelector('table');
    for (let row of table.rows) {
        const secondCell = row.cells[1];
        if (headerCell === null || secondCell.innerText !== headerCell.innerText) {
            headerCell = secondCell;
        } else {
            headerCell.rowSpan++;
            secondCell.remove();
        }
    }
}

// <th>#</th>  
// <th>Pillar</th>  
// <th>Sub Pillar</th>                                                                                    
// <th>ประเภท</th>       
// <th>Criteria</th>  
// <th>เพิ่มเติม</th> 