
import * as Extra from './extra.js';
var stepindex =0;
var readonly = "";
var disabled = "";
var evdata = [];
var evextradata = [];
$(function() {

    pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }

    getEv($('#evid').val(),route.userid).then(data => {
        RenderTable(data,1);
        //RenderTable(data,2);
        RenderExtraTable(data.extracriteriatransactions,data.extrascoring,data.finalextrascoring);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        // RowSpan("extra_criteriatable");
        // $('#sumofweight').html(data.sumweigth);
        // RowSpanExtra("extra_subpillarindex");
        if(jQuery.isEmptyObject(data.scoringstatus) ){

            $('.inpscore').prop("disabled", false);
        }else{
            $('.inpscore').prop("disabled", true);
            readonly = "readonly";
            disabled = "disabled";
        }
    //    callDataTable();
    }).catch(error => {})
});

function callDataTable(){
    $('#evexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evdata,
        columns : [
            { "data" : "pillar" },
            { "data" : "subpillar" },
            { "data" : "subpillarindex" },
            { "data" : "criteria" },
            { "data" : "score" },
            { "data" : "comment" },
            { "data" : "finalscore" },
            { "data" : "finalcomment" },
        ],
        
        searching: false,
        paging:   false,
        ordering: false,
        info:     false,
        pageLength : 10,
        language: {
            zeroRecords: " ",
            search: "ค้นหา: ",  
            sLengthMenu: "จำนวน _MENU_ รายการ",
            info: "จำนวน _START_ - _END_ จาก _TOTAL_ รายการ",
            paginate: {
                previous: 'ก่อนหน้า',
                next: 'ถัดไป'
            }
        },
        buttons: [
            { 
                extend: 'excelHtml5',
               
                className: 'btn-primary',
                
                text: 'Excel',
                title: function () { 
                    return null; 
                },
                filename: function() {
                    return "รายการ EV (Index Criteria) โครงการ" + route.projectname + ' (' + route.user + ')';
                }, 
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                },
                customize: function( xlsx ) {
                    var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    source.setAttribute('name','โครงการ' + route.projectname);
                }, 
            },
            { 
                extend: 'pdfHtml5',
                // pageSize: 'A4',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                customize: function(doc) {
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:14                                 
                    };
                    doc.styles.title.alignment = 'left';
                    doc.pageMargins = [30, 30, 30, 30];
                    doc.content[1].table.widths = ['*','*', '*', '*', '*', '*', '*', '*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                       //doc.content[1].table.body[i][0].alignment = 'left';
                        doc.content[1].table.body[i][4].alignment = 'center';
                        doc.content[1].table.body[i][6].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                },
                title: function () { 
                    return "รายการ EV (Index Criteria โครงการ" + route.projectname + ' (' + route.user + ')';
                },
                filename: function() {
                    return "รายการ EV (Index Criteria) โครงการ" + route.projectname + ' (' + route.user + ')';      
                }, 
            }
            
        ],
        drawCallback: function() {
            $('.buttons-excel')[0].style.visibility = 'hidden'
            $('.buttons-pdf')[0].style.visibility = 'hidden'
        },
        bDestroy: true
    } );

    
}

function callDataTableExtra(){

    $('#evextraexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evextradata,
        columns : [
            { "data" : "category" },
            { "data" : "criteria" },
            { "data" : "score" },
            { "data" : "comment" },
            { "data" : "finalscore" },
            { "data" : "finalcomment" }
        ],
        
        searching: false,
        paging:   false,
        ordering: false,
        info:     false,
        pageLength : 10,
        language: {
            zeroRecords: " ",
            search: "ค้นหา: ",  
            sLengthMenu: "จำนวน _MENU_ รายการ",
            info: "จำนวน _START_ - _END_ จาก _TOTAL_ รายการ",
            paginate: {
                previous: 'ก่อนหน้า',
                next: 'ถัดไป'
            }
        },
        buttons: [
            { 
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Excel',
                title: function () { 
                    return null; 
                },
                filename: function() {
                    return "รายการ EV (Extra) โครงการ" + route.projectname + ' (' + route.user + ')';     
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5]
                },
                customize: function( xlsx ) {
                    var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    source.setAttribute('name','โครงการ' + route.projectname);
                }, 
            },
            { 
                extend: 'pdfHtml5',
                // pageSize: 'A4',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                customize: function(doc) {
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:14                                 
                    };
                    doc.styles.title.alignment = 'left';
                    doc.pageMargins = [30, 30, 30, 30];
                    doc.content[1].table.widths = ['*','*','*','*','*','*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][2].alignment = 'center';
                    doc.content[1].table.body[i][4].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5]
                },
                title: function () { 
                    return "รายการ EV (Extra) โครงการ" + route.projectname + ' (' + route.user + ')';
                },
                filename: function() {
                    return "รายการ EV (Extra) โครงการ" + route.projectname + ' (' + route.user + ')';    
                }, 
            }     
        ],
        drawCallback: function() {
            $('.buttons-excel')[0].style.visibility = 'hidden'
            $('.buttons-pdf')[0].style.visibility = 'hidden'
        },
        bDestroy: true
    } );
}
$(document).on('click', '#btnOnExcel', function(e) {
    // console.log(evdata);
    getEv($('#evid').val(),route.userid).then(data => {
        RenderTable2(data,1);
        
        callDataTable();
       $('#evexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});
$(document).on('click', '#btnOnPdf', function(e) {
    console.log('here');
    getEv($('#evid').val(),route.userid).then(data => {
        RenderTable2(data,1);
        callDataTable();
       $('#evexporttable').DataTable().buttons(0,1).trigger();
   }).catch(error => {})
});

$(document).on('click', '#btnOnExcelExtra', function(e) {
    getEv($('#evid').val(),route.userid).then(data => {
        // console.log(data);
        RenderExtraTable2(data.extracriteriatransactions,data.extrascoring);
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});


$(document).on('click', '#btnOnPdfExtra', function(e) {
    
    getEv($('#evid').val(),route.userid).then(data => {
        console.log(evextradata);
        RenderExtraTable2(data.extracriteriatransactions,data.extrascoring);
       
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,1).trigger();
    }).catch(error => {})
});


function getEv(evid,userid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/getev`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid,
            userid : userid
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

  $(document).on('click', '#togglecomment', function(e) {
      $('.toggle').toggle();
   });
function RenderTable(data,evtype){
    var html =``;
    evdata = [];
    var userid = route.userid;
    data.pillars.some((pillar,index) => {
        if(pillar.ev_type_id == evtype){
            data.criteriatransactions.some((criteria,item) => {
                if(criteria.ev_type_id == evtype && criteria.pillar_id == pillar.id){
                    var textvalue = '';
                    var checkvalue = '';
                    var comment = '';
                    var finaltextvalue = '';
                    var finalcheckvalue = '';
                    var finalcomment = '';

                    var hiddenfinal = "";
                    
                    var checkscore = criteria.scoring.filter(x => x.user_id == userid); 
                    if(typeof(checkscore[0]) != "undefined"){
                        var _scoring = checkscore[0];
                        if(_scoring['comment']){comment = _scoring['comment'];}
                        if(_scoring['scoretype'] == 1){
                            textvalue = _scoring['score'];
                        }else if(_scoring['scoretype'] == 2){
                            if(_scoring['score'] == 1){
                                checkvalue = "checked";
                            }
                        }
                    }
                     var showscore = textvalue;
                     var showcriteria = criteria.subpillarindex['name'];

                    var criterianame = `<div class="form-group"><label>กรอกเกรด (A - F)</label>
                    <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="score" value="${textvalue}"  class="form-control form-control-lg inpscore gradescore" ${readonly}></div>`;

                    if(criteria.criteria != null){
                     showscore = checkvalue;
                     showcriteria = criteria.criteria['name'];
                    criterianame = `<label class="form-check-label">
                                        <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="score" style="vertical-align: middle" class="form-check-input-styled-info inpscore checkscore" ${checkvalue} ${disabled}>
                                        ${criteria.criteria['name']}
                                    </label>`;
                    }
        
                    criterianame += `<div class="toggle"><div class="form-group">
                                        <label><i>ความเห็น</i></label>
                                        <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="comment" value="${comment}"  class="form-control form-control-lg inpscore comment" ${readonly}>
                                        </div>
                                    </div>`;

                    if($('#isfinal').val() == 0){
                        hiddenfinal = "hidden";
                    }


                    var finalcheckscore = criteria.scoring.filter(x => x.user_id == null); 
                    if(typeof(finalcheckscore[0]) != "undefined"){
                        var _finalscoring = finalcheckscore[0];
                        if(_finalscoring['comment']){comment = _finalscoring['comment'];}
                        if(_finalscoring['scoretype'] == 1){
                            finaltextvalue = _finalscoring['score'];
                        }else if(_finalscoring['scoretype'] == 2){
                            if(_finalscoring['score'] == 1){
                                finalcheckvalue = "checked";
                            }
                        }
                    }

                    var showfinalscore = finaltextvalue;

                    var warningtext ='';
                    var warninglabel ='';
                    if(finaltextvalue != textvalue){
                        warningtext ='text-danger';
                    }
                    if(finalcheckvalue != checkvalue){
                        warninglabel ='text-danger';
                    }

                     evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": criteria.subpillarindex['name'], "criteria": showcriteria, "score" : showscore , "comment" : comment , "finalscore" : showfinalscore , "finalcomment" : finalcomment });

                    var finalcriterianame = `<div class="form-group"><label>กรอกเกรด (A - F)</label><input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="finalscore" value="${finaltextvalue}" class="form-control form-control-lg " readonly ></div>`;

                    if(criteria.criteria != null){
                        showfinalscore = finalcheckvalue;
                        finalcriterianame = `<label class="form-check-label">
                                        <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="finalscore"  class="form-check-input-styled-info" style="vertical-align: middle" ${finalcheckvalue} disabled>
                                        <span class="">${criteria.criteria['name']}<span>
                                    </label>`;
                    }
        
                    finalcriterianame += `<div class="toggle"><div class="form-group">
                                        <label><i>ความเห็น</i></label>
                                        <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="finalcomment" value="${finalcomment}" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                    `; 
                    html += `<tr > 
                    <td style="font-size:18px"> ${criteria.pillar['name']}</td>                                            
                    <td style="font-size:18px"> ${criteria.subpillar['name']}</td>    
                    <td style="font-size:18px"> ${criteria.subpillarindex['name']}</td>   
                    <td style="font-size:18px"> ${criterianame} </td>       
                    <td style="font-size:18px" ${hiddenfinal}> ${finalcriterianame}</td>                                      
                </tr>`
                }
            });

        }
    });
    if(evtype == 1){
        $("#criteria_transaction_wrapper_tr").html(html);
    }else if(evtype == 2){
        $("#extra_criteria_transaction_wrapper_tr").html(html);
    }  
}

function RenderTable2(data,evtype){

    evdata = [];
    var userid = route.userid;
    data.pillars.some((pillar,index) => {
        if(pillar.ev_type_id == evtype){
            data.criteriatransactions.some((criteria,item) => {
                if(criteria.ev_type_id == evtype && criteria.pillar_id == pillar.id){
                    var textvalue = '';
                    var checkvalue = '';
                    var comment = '';
                    var finaltextvalue = '';
                    var finalcheckvalue = '';
                    var finalcomment = '';

                    
                    var checkscore = criteria.scoring.filter(x => x.user_id == userid); 
                    if(typeof(checkscore[0]) != "undefined"){
                        var _scoring = checkscore[0];
                        if(_scoring['comment']){comment = _scoring['comment'];}
                        if(_scoring['scoretype'] == 1){
                            textvalue = _scoring['score'];
                        }else if(_scoring['scoretype'] == 2){
                            if(_scoring['score'] == 1){
                                checkvalue = "checked";
                            }
                        }
                    }

                    var finalcheckscore = criteria.scoring.filter(x => x.user_id == null); 
                    if(typeof(finalcheckscore[0]) != "undefined"){
                        var _finalscoring = finalcheckscore[0];
                        if(_finalscoring['comment']){finalcomment = _finalscoring['comment'];}
                        if(_finalscoring['scoretype'] == 1){
                            finaltextvalue = _finalscoring['score'];
                        }else if(_finalscoring['scoretype'] == 2){
                            if(_finalscoring['score'] == 1){
                                finalcheckvalue = "checked";
                            }
                        }
                    }


                     var showcriteria = criteria.subpillarindex['name'];
                     var score = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`).val();
                     var comment = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="comment"]`).val();
                     var finalscore = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="finalscore"]`).val();
                     var finalcomment = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="finalcomment"]`).val();
                     
                    if(criteria.criteria != null){

                        showcriteria = criteria.criteria['name'];

                        if($($(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`)).is(":checked")){
                                score = 'x';
                        }else{
                            score = '';
                        }


                        if($($(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="finalscore"]`)).is(":checked")){
                            finalscore = 'x';
                        }else{
                            finalscore = '';
                        }
                    }


        
                     evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": criteria.subpillarindex['name'], "criteria": showcriteria, "score" : score , "comment" : comment, "finalscore" : finalscore , "finalcomment" : finalcomment });
                     
                }
            });

        }
    }); 
    // console.log(evdata);
}

function RenderExtraTable(data,scoring,finalscoring){
    var html =``;
    var readonly =``;

    data.forEach(function (criteriatransaction,index) {
        console.log(criteriatransaction);
        var checkscore = scoring.filter(x => x.extra_critreria_transaction_id == criteriatransaction.id)[0]; 
        var checkfinalscore = finalscoring.filter(x => x.extra_critreria_transaction_id == criteriatransaction.id)[0]; 
        var score = '';
        var comment = '';
        var finalscore = '';
        var finalcomment = '';
            if(!jQuery.isEmptyObject(checkscore) ){
                score = checkscore.scoring;
                if(checkscore.comment){comment = checkscore.comment;}
            }
            var hiddenfinal = "";
            if($('#isfinal').val() == 0){
                hiddenfinal = "hidden";
            }

        if(!jQuery.isEmptyObject(checkfinalscore) ){
                finalscore = checkfinalscore.scoring;
                if(checkfinalscore.comment){finalcomment = checkfinalscore.comment;}
            }
            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
                <div class="form-group">
                        <label>กรอกคะแนน (0-5)</label>
                        <input type="text" value="${score}" data-id="${criteriatransaction.id}" data-type="score" class="form-control form-control-lg inputextrascore extravalue inpscore numeralformat2" ${readonly}>
                    </div>
                    <div class="toggle"><div class="form-group">
                        <label><i>ความเห็น</i></label>
                        <input type="text" value="${comment}" data-id="${criteriatransaction.id}" data-type="comment" class="form-control form-control-lg inpscore inputextracomment" >
                    </div>
                </div>
            </td> 
            <td ${hiddenfinal}> 
                <div class="form-group">
                        <label>กรอกคะแนน (0-5)</label>
                        <input type="text" value="${finalscore}" data-id="${criteriatransaction.id}" data-type="finalscore" class="form-control form-control-lg inputextrascore extravalue inpscore numeralformat2" ${readonly}>
                    </div>
                    <div class="toggle"><div class="form-group">
                        <label><i>ความเห็น</i></label>
                        <input type="text" value="${finalcomment}" data-id="${criteriatransaction.id}" data-type="finalcomment" class="form-control form-control-lg inpscore inputextracomment" >
                    </div>
                </div>
            </td> 
    </tr>`
    });

    $("#extra_criteria_transaction_wrapper_tr").html(html);
}

function RenderExtraTable2(data,scoring){

    evextradata =[];
    data.forEach(function (criteriatransaction,index) {
        var score = $(`input[data-id="${criteriatransaction.id}"][data-type="score"]`).val();
        var comment = $(`input[data-id="${criteriatransaction.id}"][data-type="comment"]`).val();
        var finalscore = $(`input[data-id="${criteriatransaction.id}"][data-type="finalscore"]`).val();
        var finalcomment = $(`input[data-id="${criteriatransaction.id}"][data-type="finalcomment"]`).val();

        evextradata.push({"category":  criteriatransaction.extracategory['name'] , "criteria": criteriatransaction.extracriteria['name'], "score": score , "comment" : comment, "finalscore": finalscore , "finalcomment" : finalcomment });

    });

}

function RowSpan(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
    let cell4 = "";
    let cell5 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        const forthCell = row.cells[3];
        const fifthCell = row.cells[4];
        if (cell1 === null || firstCell.innerText !== cell1.innerText) {
            cell1 = firstCell;
        } else {
            cell1.rowSpan++;
            firstCell.remove();
        }
        if (cell2 === null || secondCell.innerText !== cell2.innerText) {
            cell2 = secondCell;
        } else {
            cell2.rowSpan++;
            secondCell.remove();
        }
        if (cell3 === null || thirdCell.innerText !== cell3.innerText) {
            cell3 = thirdCell;
        } else {
            cell3.rowSpan++;
            thirdCell.remove();
        }
        if (cell4 === null || forthCell.innerText !== cell4.innerText) {
            cell4 = forthCell;
        } else {
            if (forthCell.innerText.includes("placeholder") == true){
                cell4.rowSpan++;
                forthCell.remove();
            }
        }
    }
}

function RowSpanWeight(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        if (cell1 === null || firstCell.innerText !== cell1.innerText) {
            cell1 = firstCell;
        } else {
            cell1.rowSpan++;
            firstCell.remove();
        }
        if (cell2 === null || secondCell.innerText !== cell2.innerText) {
            cell2 = secondCell;
        } else {
            cell2.rowSpan++;
            secondCell.remove();
        }
        if (cell3 === null || thirdCell.innerText !== cell3.innerText) {
            cell3 = thirdCell;
        } else {
            cell3.rowSpan++;
            thirdCell.remove();
        }
    }
}

// $(document).on('change', '.gradescore', function(e) {
//     if(stepindex == 0){
//         if($(this).val() !== 'A' && $(this).val() !== 'B' && $(this).val() !== 'C' && $(this).val() !== 'D' && $(this).val() !== 'E' && $(this).val() !== 'F'){
//             Swal.fire({
//                 title: 'ผิดพลาด...',
//                 text: 'กรอกเกรด A-F เท่านั้น!',
//             })
//             $(this).val('');
//             return;
//         }
//     }else if(stepindex == 1){
//         if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
//             Swal.fire({
//                 title: 'ผิดพลาด...',
//                 text: 'กรอกคะแนน 0-5 เท่านั้น!',
//             })
//             $(this).val('');
//             return;
//         }  
//     }
//     addScore($(this).data('id'),$(this).val(),$(this).data('subpillarindex'),1).then(data => {
//         $('#weightsum'+$(this).data('subpillarindex')).val(data);
//     }).catch(error => {})
// });

$(document).on('change', '.gradescore', function(e) {
    if(stepindex == 0){
       if($(this).val() == 'a'){$(this).val('A')}
       if($(this).val() == 'b'){$(this).val('B')}
       if($(this).val() == 'c'){$(this).val('C')}
       if($(this).val() == 'd'){$(this).val('D')}
       if($(this).val() == 'e'){$(this).val('E')}
       if($(this).val() == 'f'){$(this).val('F')}
        
        if(($(this).val() !== 'A') && ($(this).val() !== 'B') && ($(this).val() !== 'C') && ($(this).val() !== 'D') && ($(this).val() !== 'E') && ($(this).val() !== 'F' )){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'กรอกเกรด A-F เท่านั้น!',
            })
            $(this).val('');
            return;
        }
    }else if(stepindex == 1){
        if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'กรอกคะแนน 0-5 เท่านั้น!',
            })
            $(this).val('');
            return;
        }  
    }
});

$(document).on('change', '.inputextrascore', function(e) {
    if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'กรอกคะแนน 0-5 เท่านั้น!',
        })
        $(this).val('');
        return;
    }  

    Extra.addExtraScore($(this).data('id'),$('#evid').val(),$(this).val()).then(data => {

    }).catch(error => {})
});

$(document).on('change', '.inputextracomment', function(e) {
    Extra.addExtraComment($(this).data('id'),$('#evid').val(),$(this).val()).then(data => {
    }).catch(error => {})
});


// $(document).on('change', '.checkscore', function(e) {
//     var state = 0;
//     if($(this).is(':checked') == true){
//         state=1;
//         if($(this).data("name").includes("x2")){
//             state=2;
//         }
//     }
//     addScore($(this).data('id'),state,$(this).data('subpillarindex'),2).then(data => {
//         $('#weightsum'+$(this).data('subpillarindex')).val(data);
//     }).catch(error => {})
// });

// $(document).on('change', '.comment', function(e) {
//     editComment($(this).data('id'),$(this).val()).then(data => {
//     }).catch(error => {})
// });

function addScore(transactionid,score,subpillarindex,scoretype){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/editscore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            transactionid : transactionid,
            score : score,
            subpillarindex : subpillarindex,
            scoretype : scoretype
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

  function editComment(transactionid,comment){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/editcomment`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            transactionid : transactionid,
            comment : comment
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

function updateScoringStatus(evid,gradescorelist,checkscorelist,commentlist,status){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/updatescoringstatus`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid,
            gradescorelist : gradescorelist,
            checkscorelist : checkscorelist,
            commentlist : commentlist,
            status : status
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

  $(document).on('click', '#submitscore', function(e) {
    $("#spinicon").attr("hidden",false);
    updateScoringStatus($(this).data('id'),1).then(data => {
        if(jQuery.isEmptyObject(data) ){
            $('.inpscore').prop("disabled", false);
        }else{
            $('.inpscore').prop("disabled", true);
        }
        $("#spinicon").attr("hidden",true);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'นำส่งคะแนนสำเร็จ!',
        }).then((result) => {
            window.location.reload();
        });
    }).catch(error => {})
});
var submitbutton = true;
if($('#scoringstatus').val() != "" ){
    submitbutton = false;
}
var form = $('.step-evweight').show();
$('.step-evweight').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> ก่อนหน้า',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: '<i class="icon-spinner spinner mr-2" id="spinicon" hidden/>บันทึกคะแนน'
    },
    enableFinishButton: submitbutton,
    onFinished: function (event, currentIndex) {
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการนำส่งคะแนน หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                var checkscorelist = $(".checkscore").map(function () {
                    var val = 0;
                    if($(this).is(':checked') == true){
                        val = 1;
                    }
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        value: val
                      } 
                }).get();
                
                var gradescorelist = $(".gradescore").map(function () {
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        value: $(this).val()
                      } 
                }).get();
                
                var commentlist = $(".comment").map(function () {
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        value: $(this).val()
                      } 
                }).get();


                var noblank = true;
                $('.gradescore').each(function() {
                    if($(this).val() == ''){
                        noblank = false;
                        return;
                    }
                });
        
                if (noblank == false){
                    Swal.fire({
                        title: 'ผิดพลาด...',
                        text: 'กรุณากรอกเกรด/คะแนนให้ครบ!',
                    })
                    return;
                };

                // inppercentextra
                if($("#inppercentextra").val() != ''){
                    $('.extravalue').each(function() {
                        if($(this).val() == ''){
                            noblank = false;
                            return;
                        }
                    });
            
                    if (noblank == false){
                        Swal.fire({
                            title: 'ผิดพลาด...',
                            text: 'กรุณากรอกเกรด/คะแนนให้ครบ!',
                        })
                        return;
                    };
                }

                $("#spinicon").attr("hidden",false);
                updateScoringStatus($('#evid').val(),gradescorelist,checkscorelist,commentlist,1).then(data => {
                    if(jQuery.isEmptyObject(data) ){
                        $('.inpscore').prop("disabled", false);
                    }else{
                        $('.inpscore').prop("disabled", true);
                    }
                    $("#spinicon").attr("hidden",true);
                    Swal.fire({
                        title: 'สำเร็จ...',
                        text: 'นำส่งคะแนนสำเร็จ!',
                    }).then((result) => {
                        window.location.reload();
                    });
                }).catch(error => {})
            }
        });


    },
    transitionEffect: 'fade',
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
        stepindex = currentIndex;
        return true;
    },   
});

    // Initialize validation
    $('.step-evweight').validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-invalid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Unstyled checkboxes, radios
            if (element.parents().hasClass('form-check')) {
                error.appendTo( element.parents('.form-check').parent() );
            }

            // Input with icons and Select2
            else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Input group, styled file input
            else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            // Other elements
            else {
                error.insertAfter(element);
            }
        },
        rules: {
            email: {
                email: true
            }
        }
    });