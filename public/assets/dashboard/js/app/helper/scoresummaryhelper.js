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

    getSummaryEv($('#evid').val()).then(data => {
        $('#showpercent').html(parseFloat(data.projectgrade.percent).toFixed(2));
        $('#showgrade').html(data.projectgrade.grade);
        sumGrade(data);
        RenderTable(data,1);
        if(data.ev.percentextra > 0){ 
            RenderExtraTable(data.extracriteriatransactions,data.extrascorings);
        }
         $(".loadprogress").attr("hidden",true);
         RowSpan("criteriatable");

        $('.inpscore').prop("disabled", true);
        

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
            { "data" : "comment" }
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
                    return "สรุปคะแนน Index โครงการ" + $('#projectname') .val()    
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5 ]
                },
                customize: function( xlsx ) {
                    var fname =  $('#projectname').val().length > 20 ? $('#projectname').val().substr(0, 19) + '…' : $('#projectname').val();
                    var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    source.setAttribute('name',fname);
                }, 
            },
            { 
                extend: 'pdfHtml5',
                pageSize: 'A4',
                // orentation: 'landscape',
                customize: function(doc) {
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:14                                 
                    };
                    doc.styles.title.alignment = 'left';
                    doc.pageMargins = [30, 30, 30, 30];
                    doc.content[1].table.widths = ['*','*', '*', '*', '*', '*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                    //doc.content[1].table.body[i][0].alignment = 'left';
                        doc.content[1].table.body[i][4].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5 ]
                },
                title: function () { 
                    return "สรุปคะแนน Index โครงการ" + $('#projectname') .val() ;  
                },
                filename: function() {
                    return "สรุปคะแนน Index โครงการ" + $('#projectname') .val()   ;     
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
            { "data" : "comment" }
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
                    return "สรุปคะแนน Extra โครงการ" + $('#projectname') .val()       
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3]
                },
                customize: function( xlsx ) {
                    var fname =  $('#projectname').val().length > 20 ? $('#projectname').val().substr(0, 19) + '…' : $('#projectname').val();
                    var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    source.setAttribute('name',fname);
                },
            },
            { 
                extend: 'pdfHtml5',
                pageSize: 'A4',
                // orentation: 'landscape',
                customize: function(doc) {
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:14                                 
                    };
                    doc.styles.title.alignment = 'left';
                    doc.pageMargins = [30, 30, 30, 30];
                    doc.content[1].table.widths = ['*','*','*','*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][2].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3]
                },
                title: function () { 
                    return "สรุปคะแนน Extra โครงการ" + $('#projectname') .val()  ;
                },
                filename: function() {
                    return "สรุปคะแนน Extra โครงการ" + $('#projectname') .val()  ;     
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
    getSummaryEv($('#evid').val(),route.userid).then(data => {
         RenderTable2(data,1);
         console.log(evdata);
         callDataTable();
         //console.log('evdata');
       $('#evexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});
$(document).on('click', '#btnOnPdf', function(e) {
    // console.log('here');

    getSummaryEv($('#evid').val(),route.userid).then(data => {
        RenderTable2(data,1);
        callDataTable();
       $('#evexporttable').DataTable().buttons(0,1).trigger();
   }).catch(error => {})
});

$(document).on('click', '#btnOnExcelExtra', function(e) {
        // RenderExtraTable(data.extracriteriatransactions,data.extrascorings);
    getSummaryEv($('#evid').val(),route.userid).then(data => {
       // console.log(data);
        RenderExtraTable2(data.extracriteriatransactions,data.extrascoring);
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});


$(document).on('click', '#btnOnPdfExtra', function(e) {
    getSummaryEv($('#evid').val(),route.userid).then(data => {
        RenderExtraTable2(data.extracriteriatransactions,data.extrascoring);
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,1).trigger();
    }).catch(error => {})
});


function getSummaryEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/getsummaryev`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid
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

  
  function sumGrade(data){
    var html1 =``;
    var html2 =``;
    var pillarpercent4 = 0;
    var pillarpercent3 = 0;
    var pillarpercent2 = 0;
    var pillarpercent1 = 0;
    data.finalgrade.forEach((grade,index) => {
        $('#chartpillar' + (index+1)).html(parseFloat(grade.percent).toFixed(2));
        $('#pillar' + (index+1)).html(parseFloat(grade.percent).toFixed(2));
        $('#gradepillar' + (index+1)).html(grade.grade);
 
        if(index == 0){
            pillarpercent4 = grade.percent;
        }else if(index == 1){
            pillarpercent3 = grade.percent;
        }else if(index == 2){
            pillarpercent2 = grade.percent;
        }else if(index == 3){
            pillarpercent1 = grade.percent;
        }

// console.log(pillarpercent1 + ' ' + pillarpercent2 + pillarpercent3 + ' ' + pillarpercent3);

        // pillarpercent4 = Math.round(pillarpercent4 * 100) / 100
        // pillarpercent3 = Math.round(pillarpercent3 * 100) / 100
        // pillarpercent2 = Math.round(pillarpercent2 * 100) / 100
        // pillarpercent1 = Math.round(pillarpercent1 * 100) / 100

        if(index < 4){
            var basepillar = ``;
            if(grade.pillar_id == 1){
                basepillar = `Management`;
            }
            if(grade.pillar_id == 2){
                basepillar = `Technology`;
            }
            if(grade.pillar_id == 3){
                basepillar = `Marketability`;
            }
            if(grade.pillar_id == 4){
                basepillar = `Business Prospect`;
            }
            html1 += `<tr>
            <td>${basepillar}</td>
            <td style="text-align: center;">${parseFloat(grade.percent).toFixed(2)}</td>
            <td style="text-align: center;">${grade.grade}</td>
            <tr>`
        }else{
            var basepillar = ``;
            if(grade.pillar_id == 5){
                basepillar = `Management`;
            }
            if(grade.pillar_id == 6){
                basepillar = `เทคโนโลยี`;
            }
            if(grade.pillar_id == 7){
                basepillar = `การตลาด`;
            }
            if(grade.pillar_id == 8){
                basepillar = `ธุรกิจ`;
            }
            html2 += `<tr>
            <td>${basepillar}</td>
            <td style="text-align: center;">${parseFloat(grade.percent).toFixed(2)}</td>
            <td style="text-align: center;" >${grade.grade}</td>
            <tr>`
        }

    });  
    // var angle = grade.percent*1.8;
    //console.log(pillarpercent4);




    $('.chart-skills4').find('span:nth-child(1)').text(`${parseFloat(pillarpercent4).toFixed(2)}`);
    $('.chart-skills4').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent4*1.8}deg)`);
    $('.chart-skills4').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent4}deg)`);
    if(pillarpercent4 > 95){
        $('.chart-skills4').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills3').find('span:nth-child(1)').text(`${parseFloat(pillarpercent3).toFixed(2)}`);
    $('.chart-skills3').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent3*1.8}deg)`);
    $('.chart-skills3').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent3}deg)`);
    if(pillarpercent3 > 95){
        $('.chart-skills3').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills2').find('span:nth-child(1)').text(`${parseFloat(pillarpercent2).toFixed(2)}`);
    $('.chart-skills2').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent2*1.8}deg)`);
    $('.chart-skills2').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent2}deg)`);
    if(pillarpercent2 > 95){
        $('.chart-skills2').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills').find('span:nth-child(1)').text(`${parseFloat(pillarpercent1).toFixed(2)}`);
    $('.chart-skills').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent1*1.8}deg)`);
    $('.chart-skills').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent1}deg)`);
    if(pillarpercent1 > 95){
        $('.chart-skills').find('span:nth-child(1)').css('top', `20px`);
    }

    $("#chartarea").attr("hidden",false);
    $("#gradesummary_wrapper_tr").html(html1); 
    $("#extra_gradesummary_wrapper_tr").html(html2); 
  }

  function RowSpanSummary(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
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

    }
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

$(document).on('click', '#togglecomment', function(e) {
    $('.toggle').toggle();
 });


 function RenderTable(data,evtype){
    var html =``;

    data.criteriatransactions.forEach((criteria,index) => {
        if(criteria.ev_type_id == evtype){
            var textvalue = '';
            var checkvalue = '';
            var comment = '';
            var raw = 0;

            var showscore = '';
            var showcriteria = criteria.subpillarindex['name'];

            if(criteria.sumscoring != null){
                if(criteria.sumscoring['comment'] != null){comment = criteria.sumscoring['comment'];}
                if(criteria.sumscoring['scoretype'] == 1){
                    textvalue = criteria.sumscoring['score'];
                    if(textvalue == 'A'){
                        raw = 5;
                    }else if(textvalue == 'B'){
                        raw = 4;
                    }else if(textvalue == 'C'){
                        raw = 3;
                    }else if(textvalue == 'D'){
                        raw = 2;
                    }else if(textvalue == 'E'){
                        raw = 1;
                    }
                    showscore = textvalue;
                }else if(criteria.sumscoring['scoretype'] == 2){
                    if(criteria.sumscoring['score'] == '1'){
                        checkvalue = "checked";
                        showscore = 'x';
                    }


                }
            }

            var criterianame = `<label>กรอกเกรด/คะแนน</label>
                                    <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="score" placeholder="" value="${textvalue}" class="form-control inpscore">`;

            if(criteria.criteria != null){
                criterianame = `<label class="form-check-label">
                                    <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-type="score" data-subpillarindex="${criteria.subpillarindex['id']}" style="vertical-align: middle" class="form-check-input-styled-info inpscore" ${checkvalue}>
                                    ${criteria.criteria['name']}
                                </label>`;
            }

            criterianame += `<div class="toggle"><div class="form-group">
                                <label><i>ความเห็น</i></label>
                                <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" data-type="comment" class="form-control inpscore" disabled>
                                </div>
                            </div>`;

           // evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": criteria.subpillarindex['name'], "criteria": showcriteria, "score" : showscore , "comment" : comment });

            html += `<tr > 
            <td> ${criteria.pillar['name']}</td>                                            
            <td> ${criteria.subpillar['name']}</td>    
            <td> ${criteria.subpillarindex['name']}</td>   
            <td> ${criterianame} </td>                                          
            </tr>`
        }
        });
        if(evtype == 1){
            $("#criteria_summary_wrapper_tr").html(html);
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
                     var score = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`).val();
                     var comment = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="comment"]`).val();
                     
                    if(criteria.criteria != null){
                     showscore = checkvalue;
                     showcriteria = criteria.criteria['name'];

                     if($($(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`)).is(":checked")){
                            score = 'x';
                     }else{
                        score = '';
                     }
                    }
        
                     evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": criteria.subpillarindex['name'], "criteria": showcriteria, "score" : score , "comment" : comment });
                }
            });

        }
    }); 
    // console.log(evdata);
}


function RenderExtraTable(data,extrascorings){
    var html =``;
    data.forEach(function (criteriatransaction,index) {
        var find = extrascorings.filter(function(result) {
            return result.ev_id === criteriatransaction.ev_id && result.extra_critreria_transaction_id === criteriatransaction.id;
          });
          
         var comment = '';
         if(find[0].comment != null){
            comment = find[0].comment;
         }
            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>กรอกคะแนน (0 - 5) <a href="#" data-toggle="modal" class="text-grey conflictextrascore" data-id="${criteriatransaction.id}"><i class="icon-folder-open3"></i></a></label>
                <input type="text" value="${find[0].scoring}" data-id="${criteriatransaction.id}"  data-type="score" class="form-control inputextrascore weigthvalue decimalformat" readonly >

                <div class="toggle"><div class="form-group">
                    <label><i>ความเห็น</i></label>
                    <input type="text" data-id="${criteriatransaction.id}" value="${comment}" class="form-control form-control-lg" data-type="comment" inpscore inputextracomment" disabled>
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

        evextradata.push({"category":  criteriatransaction.extracategory['name'] , "criteria": criteriatransaction.extracriteria['name'], "score": score , "comment" : comment });

    });
console.log(evextradata);
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


var submitbutton = true;
if($('#evstatus').val() >= 5 ){
    submitbutton = false;
}
var form = $('.step-evweight').show();
$('.step-evweight').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    enableKeyNavigation: false,
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> ก่อนหน้า',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: '<i class="icon-spinner spinner mr-2" id="spinicon" hidden/>บันทึกคะแนน'
    },
    enableFinishButton: false,
    onFinished: function (event, currentIndex) {

    },
    transitionEffect: 'fade',
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
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