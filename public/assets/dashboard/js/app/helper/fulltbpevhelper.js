import * as Ev from './ev.js';
import * as Pillar from './pillar.js';
import * as SubPillar from './subpillar.js';
import * as PillaIndexWeigth from './pillaindexweigth.js';
import * as Extra from './extra.js';

var popupmessage = null;

var countchecklist = 0;
var globalNewIndex = 0;
var readonly = "";
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

    Ev.getEvByFullTbp($('#fulltbpid').val()).then(data => {
        RenderTable(data.criteriatransactions,data.pillaindexweigths);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        

        if (data.extracriteriatransactions.length != 0) {
            RenderExtraTable(data.extracriteriatransactions); 
        }

        $(".loadprogress").attr("hidden",true);
        

        if (data.extracriteriatransactions.length != 0) {
            RowSpanExtra("extracriteriatable");
        }

        callDataTable();
       
        if (data.extracriteriatransactions.length != 0) {
            callDataTableExtra();
        }

       var cookieval = getCookie("forcedownload");
        if(cookieval == '1'){
            $('#evexporttable').DataTable().buttons(0,0).trigger();
        }else if(cookieval == '2'){
            $('#evexporttable').DataTable().buttons(0,1).trigger();
        }else if(cookieval == '3'){
            $('#evextraexporttable').DataTable().buttons(0,0).trigger();
        }else if(cookieval == '4'){
            $('#evextraexporttable').DataTable().buttons(0,1).trigger();
        }
        setCookie("forcedownload", "")

    }).catch(error => {})


});

function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}


function callDataTable(){
        $('#evexporttable').DataTable( {
            dom: 'Bfrtip',
            data: evdata,
            columns : [
                { "data" : "pillar" },
                { "data" : "subpillar" },
                { "data" : "subpillarindex" },
                { "data" : "criteria" }
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
                        return "รายการ EV (Index Criteria) โครงการ" + $('#projectname').val() ;      
                    }, 
                    exportOptions: {
                        columns: [ 0, 1,2,3 ]
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
                        doc.content[1].table.widths = ['*','*', '*', '*']
                        var rowCount = doc.content[1].table.body.length;
                        for (var i = 1; i < rowCount; i++) {
                        doc.content[1].table.body[i][0].alignment = 'left';
                        }
                    },
                    exportOptions: {
                        columns: [ 0, 1,2,3 ]
                    },
                    title: function () { 
                        return "รายการ EV (Index Criteria) โครงการ" + $('#projectname').val() ; ; 
                    },
                    filename: function() {
                        return "รายการ EV (Index Criteria) โครงการ" + $('#projectname').val() ;       
                    }, 
                }
                
            ],
            drawCallback: function() {
                $('.buttons-excel')[0].style.visibility = 'hidden'
                $('.buttons-pdf')[0].style.visibility = 'hidden'
            }
        } );
}

function callDataTableExtra(){
   
    $('#evextraexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evextradata,
        columns : [
            { "data" : "category" },
            { "data" : "criteria" }
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
                    return "รายการ EV (Extra) โครงการ" + $('#projectname').val() ;       
                }, 
                exportOptions: {
                    columns: [ 0, 1,]
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
                    doc.content[1].table.widths = ['*','*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'left';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1]
                },
                title: function () { 
                    return "รายการ EV (Extra) โครงการ" + $('#projectname').val() ; ; 
                },
                filename: function() {
                    return "รายการ EV (Extra) โครงการ" + $('#projectname').val() ;     
                }, 
            }
            
        ],
        drawCallback: function() {
            $('.buttons-excel')[1].style.visibility = 'hidden'
            $('.buttons-pdf')[1].style.visibility = 'hidden'
        }
    } );
}

$("#btnOnExcel").on('click', function() {
    if (!$('#evexporttable').DataTable().data().any() ) {
        setCookie("forcedownload", "1");
        window.location.reload();
    }else{
        $('#evexporttable').DataTable().buttons(0,0).trigger();
    }

});

$("#btnOnPdf").on('click', function() {
    if (!$('#evexporttable').DataTable().data().any() ) {
        setCookie("forcedownload", "2");
        window.location.reload();
    }else{
        $('#evexporttable').DataTable().buttons(0,1).trigger();
    }
   
});

$("#btnOnExcelExtra").on('click', function() {

    if (!$('#evextraexporttable').DataTable().data().any() ) {

        setCookie("forcedownload", "3");
        window.location.reload();
    }else{
        $('#evextraexporttable').DataTable().buttons(0,0).trigger();
    }
    

});

$("#btnOnPdfExtra").on('click', function() {
    if (!$('#evextraexporttable').DataTable().data().any() ) {
        setCookie("forcedownload", "4");
        window.location.reload();
    }else{
        $('#evextraexporttable').DataTable().buttons(0,1).trigger();
    }
    
});

$(document).on('click', '#btnaddclustergroup', function(e) {
    Pillar.getPillar(1).then(data => {
        var html ='<option value="0" >==เลือกรายการ==</option>';
        data.forEach(function (pilla,index) {
                html += `<option value="${pilla['id']}" >${pilla['name']}</option>`
            });
         $("#pillar").html(html);
         $('#modal_add_clustergroup').modal('show');
    }).catch(error => {})
});

$(document).on('change', '#pillar', function(e) {
    var html ='<option value="0" >==เลือกรายการ==</option>';
    SubPillar.getSubPillar($('#evid').val(),$(this).val()).then(data => {
        data.forEach(function (ev,index) {
                html += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
        $("#subpillar").html(html);
        $("#subpillar option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
        Pillar.getRelatedEv($('#evid').val()).then(data => {
            var html =``;
            var html1 =`<option value="0" >=== EV ที่คล้ายกัน ===</option>`;

            if(data.length > 0){
                $("#relateev").attr("hidden",false);
            }else{
                $("#relateev").attr("hidden",true);
            } 
            data.forEach(function (ev,index) {
                    html += `<button type="button" class="btn badge badge-light badge-striped badge-striped-left border-left-info" id="relateevid" data-id="${ev['id']}">${ev['name']}</button>&nbsp; `
                    html1 += `<option value="${ev['id']}" >${ev['name']}</option>`
                });
             $("#similarev").html(html1);
        }).catch(error => {})
    }).catch(error => {})
});

$(document).on('change', '#subpillar', function(e) {
    $("#grade_wrapper").attr("hidden",true);
    SubPillar.getSubPillarIndex($('#evid').val(),$(this).val()).then(data => {
        var html0 ='<option value="0" >==เลือกรายการ==</option>';
        var html1 ='';
        data.subpillarindexs.forEach(function (subpillar,index) {
            var checkindex = data.criteriatransactions.filter(x => x.ev_id == $('#evid').val() && x.sub_pillar_index_id == subpillar['id']);
            if(checkindex.length == 0){
                html0 += `<option value="${subpillar['id']}" >${subpillar['name']}  </option>`
            }
                
            });
   
        data.indextypes.forEach(function (indextype,index) {
                html1 += `<option value="${indextype['id']}" >${indextype['name']}</option>`
            });
        $("#subpillarindex").html(html0);
        $("#indextype").html(html1);
        $("#subpillarindex option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
        Pillar.getRelatedEv($('#evid').val()).then(data => {
            var html =``;
            var html1 =`<option value="0" >=== EV ที่คล้ายกัน ===</option>`;

            if(data.length > 0){
                $("#relateev").attr("hidden",false);
            }else{
                $("#relateev").attr("hidden",true);
            } 

            data.forEach(function (ev,index) {
                    // html += `<button type="button" class="btn badge badge-light badge-striped badge-striped-left border-left-info" id="relateevid" data-id="${ev['id']}">${ev['name']}</button>&nbsp; `
                    html1 += `<option value="${ev['id']}" >${ev['name']}</option>`
                });
            $("#similarev").html(html1);
        }).catch(error => {})
    }).catch(error => {})
});

$(document).on('change', '#subpillarindex', function(e) {
    countchecklist = 0;
    $('#indextype').val(1);
    $('#indextype').select2().trigger('change');
    $(this).prop('selected',true);
    $("#criteria_wrapper").attr("hidden",true);
    SubPillar.getCriteria($('#evid').val(),$(this).val()).then(data => {
        $("#chklist").html('');
        countchecklist = data.criterias.length;

        data.criterias.forEach(function (subpillarindex,index) {
            var check = '';
            var _check = data.criteriatransactions.find(x => x.criteria_id === subpillarindex['id']);
            if (_check){
                check = 'checked';
            }
            
            $("#chklist").append(`<div class="col-md-6">
                                    <div class="form-check">
                                        <input class="subpillarindexcheckbox" style="vertical-align:middle !important" type="checkbox" id="${subpillarindex['id']}" value="${subpillarindex['id']}" ${check} ><span style="font-size:18px  !important; margin-left:5px; margin-top:5px">${subpillarindex['name']}</span>  
                                    </div>
                                </div>`);
            });
    
        Pillar.getRelatedEv($('#evid').val()).then(data => {
            var html =``;
            var html1 =`<option value="0" >=== EV ที่คล้ายกัน ===</option>`;

            if(data.length > 0){
                $("#relateev").attr("hidden",false);
            }else{
                $("#relateev").attr("hidden",true);
            } 

            data.forEach(function (ev,index) {
                // html += `<button type="button" class="btn badge badge-light badge-striped badge-striped-left border-left-info" id="relateevid" data-id="${ev['id']}">${ev['name']}</button>&nbsp; `
                html1 += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
            $("#similarev").html(html1);
        }).catch(error => {})
    }).catch(error => {})
});

$(document).on('change', '#indextype', function(e) {
  if($(this).val() == 1){
    $("#grade_wrapper").attr("hidden",true);
  }else if($(this).val() == 2){
    $("#grade_wrapper").attr("hidden",false);
    Ev.getEvCheckList($('#pillar').val(),$('#subpillar').val(),$('#subpillarindex').val()).then(data => {
        console.log(data);
        var html =``;
        if(!jQuery.isEmptyObject(data)){
            if(data.gradea != 0 && data.gradeb != 0 && data.gradec != 0 && data.graded != 0 && data.gradee != 0){
                $('#gradea').val(data.gradea);
                $('#gradeb').val(data.gradeb);
                $('#gradec').val(data.gradec);
                $('#graded').val(data.graded);
                $('#gradee').val(data.gradee);
            }
        }
    }).catch(error => {})
  }
});

$(document).on('change', '#toggleselect', function(e) {
    var status = this.checked; // "select all" checked status
	$('.subpillarindexcheckbox').each(function(){ //iterate all listed checkbox items
		this.checked = status; //change ".checkbox" checked status
	});
  });

$('.steps-basic').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    enableFinishButton: false,
    enableKeyNavigation: false,
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> กลับ',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: 'เพิ่มรายการ <i class="icon-arrow-right14 ml-2" />'
    },
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
        if(currentIndex != 3){
            $(".actions").find(".libtn").remove();
        }
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        if (currentIndex > newIndex) {
            return true;
        }
        if(newIndex == 3 && $('#subpillarindex').val() != 0){      
            if($('#indextype').val() == 2){
                if($('#gradea').val() == 0 && $('#gradeb').val() == 0 && $('#gradec').val() == 0 && $('#graded').val() == 0 && $('#gradee').val() == 0 ){
                    return false;
                 }else{
                    $(document).find(".actions ul").append(`
                    <li class='libtn'><a href='#' id='addcriteria' class='btn bg-primary' ><i class="icon-spinner spinner mr-2" id="spiniconcriteria" hidden></i>เพิ่มรายการ<i class='icon-arrow-right14 ml-2' /></a></li>`);
                 }
            }else{
                $(document).find(".actions ul").append(`
                <li class='libtn'><a href='#' id='addcriteria' class='btn bg-primary' ><i class="icon-spinner spinner mr-2" id="spiniconcriteria" hidden></i>เพิ่มรายการ<i class='icon-arrow-right14 ml-2' /></a></li>`);
            }
        }

        $('#tmpstepindex').val(newIndex);
        $('#criteriamodal').removeClass('context-menu-one'); 
        // if(newIndex > 0){
        //     $('#criteriamodal').addClass('context-menu-one'); 
        //     $(function() {
        //         $.contextMenu({
        //             selector: '.context-menu-one', 
        //             callback: function(key, options) {
        //                 //var m = "clicked: " + key;
        //                 if(key == 'add'){
        //                     $("#parent").html($( "#pillar option:selected" ).text());
        //                     $('#modal_additem').modal('show');
        //                 }
        //                 if(key == 'edit'){
        //                     $("#multipleselect").attr("hidden",true);
        //                     $("#parent").html($( "#pillar option:selected" ).text());
        //                     var isempty = false;
        //                     if($('#tmpstepindex').val() == 1){
        //                         if($('#subpillar option:selected').val() == 0)isempty=true;
        //                         $('#nameedit').val($('#subpillar option:selected').text())
        //                     }else if($('#tmpstepindex').val() == 2){
        //                         if($('#subpillarindex option:selected').val() == 0)isempty=true;
        //                         $('#nameedit').val($('#subpillarindex option:selected').text())
        //                     }else if($('#tmpstepindex').val() == 3){
        //                         $("#multipleselect").attr("hidden",false);
        //                         $('#tmpcriteria').html($('#criteria').html())
        //                         $('#nameedit').val( $("#criteria option:eq(0)").prop("selected", true).text()) 
        //                     }
        //                     if(isempty==false)$('#modal_edititem').modal('show');
        //                 }
        //             },
        //             items: {
        //                 "add": {name: "เพิ่ม" , icon: "add"},
        //                 // "edit": {name: "แก้ไข", icon: "edit"},
        //                 "sep1": "---------",
        //                 "edit": {name: "แก้ไข", icon: function(){
        //                     return 'context-menu-icon context-menu-icon-edit';
        //                 }}
        //             }
        //         });
        //         $('.context-menu-one').on('click', function(e){

        //         })    
        //     });
        // }
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
                    if($('#gradea').val() == '' || $('#gradeb').val() == '' ||$('#gradec').val() == '' ||$('#graded').val() == '' || $('#gradee').val() == ''
                     || ($('#gradea').val() == 0 && $('#gradeb').val() == 0 && $('#gradec').val() == 0 && $('#graded').val() == 0 && $('#gradee').val() == 0 )){
                        return false;
                    }else{
                        var gradea = parseInt($("#gradea").val());
                        var gradeb = parseInt($("#gradeb").val());
                        var gradec = parseInt($("#gradec").val());
                        var graded = parseInt($("#graded").val());
                        var gradee = parseInt($("#gradee").val());
                        if((gradea <= gradeb) || (gradea <= gradec) ||(gradea <= graded) ||(gradea <= gradee)){
                            return false;
                        }
                            
                        if((gradeb >= gradea) || (gradeb <= gradec) ||(gradeb <= graded) ||(gradeb <= gradee)){
                            return false;
                        }
                    
                        if((gradec >= gradea) || (gradec >= gradeb) ||(gradec <= graded) ||(gradec <= gradee)){
                            return false;
                        }
                    
                        if((graded >= gradea) || (graded >= gradeb) ||(graded >= gradec) ||(graded <= gradee)){
                            return false;
                        }
                    
                        if((gradee >= gradea) || (gradee >= gradeb) ||(gradee >= gradec) ||(gradee >= graded)){
                            return false;
                        }
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
    },
    onFinished: function (event, currentIndex) {
        $(".actions").find(".libtn").remove();
    }
});

$('.steps-basic-extra').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    enableKeyNavigation: false,
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> กลับ',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: 'เพิ่มรายการ <i class="icon-arrow-right14 ml-2" />'
    },
    autoFocus: true,
    onStepChanging: function (event, currentIndex, newIndex) {
        $('#tmpstepindex').val(newIndex);
        // $('#extracriteriamodal').removeClass('context-menu-one'); 
        // if(newIndex > 0){
        //     $('#extracriteriamodal').addClass('context-menu-one'); 
        //     $(function() {
        //         $.contextMenu({
        //             selector: '.context-menu-one', 
        //             callback: function(key, options) {
        //                 if(key == 'add'){

        //                     $("#parent").html($( "#pillar option:selected" ).text());
        //                     $('#modal_addextraitem').modal('show');
        //                 }
        //                 if(key == 'edit'){
        //                     $("#multipleselect").attr("hidden",true);
        //                     $("#parent").html($( "#pillar option:selected" ).text());
        //                     var isempty = false;
        //                     if($('#tmpstepindex').val() == 1){
        //                         if($('#subpillar option:selected').val() == 0)isempty=true;
        //                         $('#nameedit').val($('#subpillar option:selected').text())
        //                     }else if($('#tmpstepindex').val() == 2){
        //                         if($('#subpillarindex option:selected').val() == 0)isempty=true;
        //                         $('#nameedit').val($('#subpillarindex option:selected').text())
        //                     }else if($('#tmpstepindex').val() == 3){
        //                         $("#multipleselect").attr("hidden",false);
        //                         $('#tmpcriteria').html($('#criteria').html())
        //                         $('#nameedit').val( $("#criteria option:eq(0)").prop("selected", true).text()) 
        //                     }
        //                     if(isempty==false)$('#modal_editextraitem').modal('show');
        //                 }
        //             },
        //             items: {
        //                 "add": {name: "เพิ่ม" , icon: "add"},
        //                 // "edit": {name: "แก้ไข", icon: "edit"},
        //                 "sep1": "---------",
        //                 "edit": {name: "แก้ไข", icon: function(){
        //                     return 'context-menu-icon context-menu-icon-edit';
        //                 }}
        //             }
        //         });
        //         $('.context-menu-one').on('click', function(e){
            
        //         })    
        //     });
        // }
        if(newIndex == 1){
            if($('#extracategory').val() == 0){
                return false;
            }else{
                return true;
            }  
        }else{
            return true;
        }
    },
    onFinishing: function (event, currentIndex) {
        return true;
    },
    onFinished: function (event, currentIndex) {
        Extra.addExtra($('#evid').val(),1,$('#extracategory').val(),$('#extracriteria').val()).then(data => {

        }).catch(error => {})
    }
});

// $.contextMenu({
//     selector: '.context-menu-two', 
//     callback: function(key, options) {
//         if(key == 'add'){
//             $("#parent").html($( "#pillar option:selected" ).text());
//             $('#modal_addextraitem').modal('show');
//         }
//         if(key == 'edit'){
//             $("#multipleselect").attr("hidden",true);
//             $("#parent").html($( "#pillar option:selected" ).text());
//             var isempty = false;
//             if($('#tmpstepindex').val() == 1){
//                 if($('#subpillar option:selected').val() == 0)isempty=true;
//                 $('#nameedit').val($('#subpillar option:selected').text())
//             }else if($('#tmpstepindex').val() == 2){
//                 if($('#subpillarindex option:selected').val() == 0)isempty=true;
//                 $('#nameedit').val($('#subpillarindex option:selected').text())
//             }else if($('#tmpstepindex').val() == 3){
//                 $("#multipleselect").attr("hidden",false);
//                 $('#tmpcriteria').html($('#criteria').html())
//                 $('#nameedit').val( $("#criteria option:eq(0)").prop("selected", true).text()) 
//             }
//             if(isempty==false)$('#modal_editextraitem').modal('show');
//         }
//     },
//     items: {
//         "add": {name: "เพิ่ม" , icon: "add"},
//         "sep1": "---------",
//         "edit": {name: "แก้ไข", icon: function(){
//             return 'context-menu-icon context-menu-icon-edit';
//         }}
//     }
// });

$(document).on('click', '#addcriteria', function(e) {
    if($('#indextype').val() == 1){
        AddGrading();
    }else{
        var criterias = [];
        $('#chklist :checked').each(function() {
            criterias.push($(this).val());
          });
          if((criterias.length == 0) || (criterias.length < parseInt($("#gradea").val()))){
            popupmessage = route.popupmessages.find(x => x.id ==40);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
                });
          }else{
            AddCheckList(criterias);
          }
    }
});

function AddCheckList(criterias){
    $("#spiniconcriteria").attr("hidden",false);
    $('#show').hide();
    Ev.addEvCheckList($('#evid').val(),$('#indextype').val(),$('#pillar').val(),$('#subpillar').val(),$('#subpillarindex').val(),criterias,$('#gradea').val(),$('#gradeb').val(),$('#gradec').val(),$('#graded').val(),$('#gradee').val()).then(data => {
         RenderTable(data.criteriatransactions,data.pillaindexweigths);
         RowSpan("criteriatable");
         if(data.result == 1){
            Pillar.getRelatedEv($('#evid').val()).then(data => {
                var html =``;
                var html1 =`<option value="0" >=== EV ที่คล้ายกัน ===</option>`;

                if(data.length > 0){
                    $("#relateev").attr("hidden",false);
                }else{
                    $("#relateev").attr("hidden",true);
                } 
                data.forEach(function (ev,index) {
                        // html += `<button type="button" class="btn badge badge-light badge-striped badge-striped-left border-left-info" id="relateevid" data-id="${ev['id']}">${ev['name']}</button>&nbsp; `
                        html1 += `<option value="${ev['id']}" >${ev['name']}</option>`
                    });
                    $("#similarev").html(html1);
                 $("#spiniconcriteria").attr("hidden",true);
                 popupmessage = route.popupmessages.find(x => x.id ==54);
                 Swal.fire({
                    title: popupmessage['title'],
                    text: popupmessage['message'],
                    });
            $("#toggleselect")[0].checked = false;     
            $('.subpillarindexcheckbox').each(function(){ 
                this.checked = false; 
            });
            }).catch(error => {})
         }else{
            $("#spiniconcriteria").attr("hidden",true);
            popupmessage = route.popupmessages.find(x => x.id ==53);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
                });
            
         }
         

    }).catch(error => {})
}

function AddGrading(){
    $("#spiniconcriteria").attr("hidden",false);
    $('#show').hide();
    Ev.addEvGrading($('#evid').val(),$('#indextype').val(),$('#pillar').val(),$('#subpillar').val(),$('#subpillarindex').val()).then(data => {
         RenderTable(data.criteriatransactions,data.pillaindexweigths);
         RowSpan("criteriatable");
        $("#spiniconcriteria").attr("hidden",true);
        if(data.result == 1){
            popupmessage = route.popupmessages.find(x => x.id ==54);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
               });
               $("#toggleselect")[0].checked = false;
               $('.subpillarindexcheckbox').each(function(){ 
                    this.checked = false; 
                });
        }else{
            popupmessage = route.popupmessages.find(x => x.id ==53);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
               });
        }

    }).catch(error => {})
}

$(document).on('change', '#existingev', function(e) {
    if ($(this).val() == 0) return;
    Ev.getEv($(this).val()).then(data => {
        RenderModalTable(data);
        RowSpan("criteriatable_modal");
        $('#modal_exisingev').modal('show');
    }).catch(error => {})
});

$(document).on('click', '#btn_modal_exisingev', function(e) {
    $(".loadprogress").attr("hidden",false);
    Ev.copyEv($('#existingev').val(),$('#evid').val()).then(data => {
        Ev.getEvByFullTbp($('#fulltbpid').val()).then(data => {
            window.location.reload();
        }).catch(error => {})
    }).catch(error => {})
});

function RenderModalTable(data){
    var html =``;
    data.forEach(function (criteria,index) {
        var criterianame = '-';
        if(criteria.criteria != null){
            criterianame = criteria.criteria['name']
        }
        html += `<tr > 
        <td> ${criteria.pillar['name']} </td>                                            
        <td> ${criteria.subpillar['name']} </td>    
        <td> ${criteria.subpillarindex['name']} </td>   
        <td> ${criterianame} </td>                                            
        </tr>`
        });
    $("#criteria_transaction_modal_wrapper_tr").html(html);
}
function RenderTable(criterias,pillaindexweigths){
    var html =``;
    evdata = [];
    criterias.forEach(function (criteria,index) {
        var criterianame = criteria.subpillarindex['name'] + ' <small>(เกรด)</small>';
        if(criteria.criteria != null){
            criterianame = criteria.criteria['name']
        }
        var subpillarindex = criteria.subpillarindex['name'];
        if(subpillarindex == null){
            subpillarindex = "-";
        }
        var find = pillaindexweigths.filter(function(result) {
            return result.ev_id == $('#evid').val() && result.pillar_id == criteria.pillar['id']  && result.sub_pillar_id == criteria.subpillar['id']  && result.sub_pillar_index_id == criteria.subpillarindex['id'];
          });
        var commentreadlonly = 'readonly';
        var weightval = '';

        if ($('#evstatus').val() >= 4 ) {
            if (route.usertypeid >= 5) {
                if(find[0].weigth){
                    weightval = `(weight = ` + find[0].weigth + `)`;
                } 
            }
            readonly = "readonly";
        }

        if ($('#evstatus').val() == 0) {
            if(route.usertypeid != 6 ){
                commentreadlonly = "";
            }
        }else if($('#evstatus').val() == 1) {
            if (route.refixstatus == 0) {
                if(route.usertypeid == 6 ){
                    commentreadlonly = "";
                }
            }else if(route.refixstatus == 1){
                if(route.usertypeid != 6 ){
                    commentreadlonly = "";
                }
            }else if(route.refixstatus == 2){
                if(route.usertypeid == 6 ){
                    commentreadlonly = "";
                }
            }
        }


        // if(route.usertypeid != 6 ){
        //     commentreadlonly = "readonly";
        // }
        
        // if ($('#evstatus').val() >= 2) {
        //     commentreadlonly = "readonly";
        // }else if($('#evstatus').val() == 0){
        //     commentreadlonly = "";
        // }
        // if (route.refixstatus == 1) {
        //     commentreadlonly = "";
        // }

        var comment = '';
        if(criteria.comment){
            comment = criteria.comment;
        }
        

        evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": subpillarindex, "criteria": criterianame});


        if(route.status == 0 || route.refixstatus == 1){
            html += `<tr > 
            <td> ${criteria.pillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" class="text-grey-300 pillarname deletepillar"><i class="icon-trash"></i></a></td>                                            
            <td> ${criteria.subpillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" class="text-grey-300 deletesubpillar"><i class="icon-trash"></i></a></td>    
            <td> ${subpillarindex} ${weightval}<a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" data-subpillarindex="${criteria.subpillarindex['id']}" class="text-grey-300 deletesubpillarindex"><i class="icon-trash"></i></a></td>   
            <td> 
                ${criterianame} 
                <div class="toggle" >
                    <div class="form-group" style="margin-top:5px">
                        <label><i>ความเห็น</i></label>
                        <input type="text" data-id="${criteria.id}" value="${comment}" class="form-control form-control-lg inpscore comment" ${commentreadlonly} >
                    </div>
                </div>
            </td>                                            
            </tr>`
        }else{
            html += `<tr > 
            <td> ${criteria.pillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" class="text-grey-300 pillarname"></a></td>                                            
            <td> ${criteria.subpillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" class="text-grey-300 "></a></td>    
            <td> ${subpillarindex} ${weightval}<a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" data-subpillarindex="${criteria.subpillarindex['id']}" class="text-grey-300 "></a></td>   
            <td> 
                ${criterianame} 
                <div class="toggle" >
                    <div class="form-group" style="margin-top:5px">
                        <label><i>ความเห็น</i></label>
                        <input type="text" data-id="${criteria.id}" value="${comment}" class="form-control form-control-lg inpscore comment" ${commentreadlonly} >
                    </div>
                </div>
            </td>                                            
            </tr>`
        }
    });
    JSON.stringify({array: evdata});
        $("#criteria_transaction_wrapper_tr").html(html);
}

function RenderExtraTable(data){
    var html =``;
    evextradata = [];
    data.forEach(function (criteria,index) {
        var weightval = '';
        var commentreadlonly = 'readonly';
        if(route.usertypeid != 6 ){
            commentreadlonly = "readonly";
        }

        if ($('#evstatus').val() >= 4) {
            if (route.usertypeid >= 5) {
                if(criteria.weight){
                    weightval = `(weight = ` + criteria.weight + `)`;
                } 
            }

            commentreadlonly = "readonly";
        }

        // if ($('#evstatus').val() >= 2) {
        //     commentreadlonly = "readonly";
        // }else if($('#evstatus').val() == 0){
        //     commentreadlonly = "";
        // }
        // if (route.refixstatus == 1) {
        //     commentreadlonly = "";
        // }


        if ($('#evstatus').val() == 0) {
            if(route.usertypeid != 6 ){
                commentreadlonly = "";
            }
        }else if($('#evstatus').val() == 1) {
            if (route.refixstatus == 0) {
                if(route.usertypeid == 6 ){
                    commentreadlonly = "";
                }
            }else if(route.refixstatus == 1){
                if(route.usertypeid != 6 ){
                    commentreadlonly = "";
                }
            }else if(route.refixstatus == 2){
                if(route.usertypeid == 6 ){
                    commentreadlonly = "";
                }
            }
        }


        var comment = '';
        if(criteria.extracomment){
            comment = criteria.extracomment;
        }

        evextradata.push({"category":  criteria.extracategory['name'] , "criteria": criteria.extracriteria['name']});


        if(route.status == 0 || route.refixstatus == 1){
            html += `<tr > 
            <td> ${criteria.extracategory['name']} ${weightval}<a href="#" data-categoryid="${criteria.extra_category_id}" class="text-grey-300 deletecategorytransaction"><i class="icon-trash"></i></a></td>                
            <td> ${criteria.extracriteria['name']} <a href="#"  data-categoryid="${criteria.extra_category_id}" data-criteriaid="${criteria.extra_criteria_id}" class="text-grey-300 deletetriteriatransaction"><i class="icon-trash"></i></a>
                <div class="toggle" >
                    <div class="form-group" style="margin-top:5px">
                        <label><i>ความเห็น</i></label>
                        <input type="text" data-id="${criteria.id}" value="${comment}" class="form-control form-control-lg inpscore extracomment" ${commentreadlonly} >
                    </div>
                </div>
            
            </td>                                            
            </tr>`
        }else{
            html += `<tr > 
            <td> ${criteria.extracategory['name']} ${weightval}<a href="#" data-categoryid="${criteria.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteria.extracriteria['name']} <a href="#"  data-categoryid="${criteria.extra_category_id}" data-criteriaid="${criteria.extra_criteria_id}" class="text-grey-300"></a>
                <div class="toggle" >
                    <div class="form-group" style="margin-top:5px">
                        <label><i>ความเห็น</i></label>
                        <input type="text" data-id="${criteria.id}" value="${comment}" class="form-control form-control-lg inpscore extracomment" ${commentreadlonly} >
                    </div>
                </div>
            </td>                                            
            </tr>`
        }

    });
 
        $("#extra_criteria_transaction_wrapper_tr").html(html);
}

function RowSpan(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
    let cell4 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        const forthCell = row.cells[3];
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
            cell4.rowSpan++;
            forthCell.remove();
        }
    }
}

function RowSpanExtra(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
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
    }
}

$(document).on('click', '.deletepillar', function(e) {
    if($('#evstatus').val() > 1)return ;
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Pillar.deletePillar($('#evid').val(),$(this).data('pillar')).then(data => {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ลบรายการสำเร็จ',
                    }).then((result) => {
                        window.location.reload();
                    });
            })
            .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_edititem', function(e) {
    if($('#tmpstepindex').val() == 1){
        SubPillar.editSubPillar($('#subpillar').val(),$('#pillar').val(),$('#nameedit').val()).then(data => {
            var html =``;
            data.forEach(function (ev,index) {
                html += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
            $("#subpillar").html(html);
        })
        .catch(error => {})
    }else if ($('#tmpstepindex').val() == 2){
        SubPillar.editSubPillarIndex($('#subpillarindex').val(),$('#subpillar').val(),$('#nameedit').val()).then(data => {
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
        })
        .catch(error => {})
    }else if ($('#tmpstepindex').val() == 3){
        SubPillar.editCriteria($('#tmpcriteria').val(),$('#subpillarindex').val(),$('#nameedit').val()).then(data => {
            var html =``;
            data.forEach(function (subpillar,index) {
                    html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
                });
            $("#criteria").html(html);
        })
        .catch(error => {})
    }

});


$(document).on('click', '.deletesubpillar', function(e) {
    if($('#evstatus').val() > 1)return ;
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            SubPillar.deleteSubPillar($('#evid').val(),$(this).data('pillar'),$(this).data('subpillar')).then(data => {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ลบรายการสำเร็จ',
                    }).then((result) => {
                        window.location.reload();
                    });
            })
            .catch(error => {})
        }
    });
});

$(document).on('click', '.deletesubpillarindex', function(e) {
    if($('#evstatus').val() > 1)return ;
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            SubPillar.deleteSubPillarIndex($('#evid').val(),$(this).data('pillar'),$(this).data('subpillar'),$(this).data('subpillarindex')).then(data => {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ลบรายการสำเร็จ',
                    }).then((result) => {
                        window.location.reload();
                    });
            })
            .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_additem', function(e) {
    var html ='<option value="0" >==เลือกรายการ==</option>';
    if($('#tmpstepindex').val() == 1){
        SubPillar.addSubPillar($('#evid').val(),$('#pillar').val(),$('#name').val()).then(data => {
            data.forEach(function (ev,index) {
                html += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
            $("#subpillar").html(html);
            $("#subpillar option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    
            })
        .catch(error => {})
    }else if($('#tmpstepindex').val() == 2){
        SubPillar.addSubPillarIndex($('#evid').val(),$('#subpillar').val(),$('#name').val()).then(data => {
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
            })
        .catch(error => {})
    }else if($('#tmpstepindex').val() == 3){
        SubPillar.addCriteria($('#evid').val(),$('#subpillarindex').val(),$('#name').val()).then(data => {
            var html =``;
            data.forEach(function (subpillar,index) {
                    html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
                });
            $("#criteria").html(html);
            $("#criteria option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
            })
        .catch(error => {})
    }
});
$(document).on('click', '#btn_modal_addextraitem', function(e) {
    var html ='<option value="0" >==เลือกรายการ==</option>';
    if($('#tmpstepindex').val() == 1){
        SubPillar.addSubPillar($('#evid').val(),$('#extrapillar').val(),$('#extraitemname').val()).then(data => {
            data.forEach(function (ev,index) {
                html += `<option value="${ev['id']}" >${ev['name']}</option>`
            });
            $("#extrasubpillar").html(html);
            $("#extrasubpillar option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    
            })
        .catch(error => {})
    }else if($('#tmpstepindex').val() == 2){
        SubPillar.addSubPillarIndex($('#evid').val(),$('#extrasubpillar').val(),$('#extraitemname').val()).then(data => {
            var html0 ='<option value="0" >==เลือกรายการ==</option>';
            var html1 ='';
            data.subpillarindexs.forEach(function (subpillar,index) {
                    html0 += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
                });
            data.indextypes.forEach(function (indextype,index) {
                    html1 += `<option value="${indextype['id']}" >${indextype['name']}</option>`
                });
            $("#extrasubpillarindex").html(html0);
            $("#indextype").html(html1);
            $("#extrasubpillarindex option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
            })
        .catch(error => {})
    }
});
// 
$(document).on('change', '#tmpcriteria', function(e) {
    $('#nameedit').val($('#tmpcriteria option:selected').text());
});

$(document).on('change', '#similarev', function(e) {
    $("#existingev").val($(this).val()).change();
    Ev.getEv($(this).val()).then(data => {
        RenderModalTable(data);
        RowSpan("criteriatable_modal");
        $('#modal_exisingev').modal('show');
    }).catch(error => {})
});

$('#chkevstatus').on('change.bootstrapSwitch', function(e) {
    var status = 0
    if(e.target.checked==true){
        status =1;
    }        
    $("#spinicon").attr("hidden",false);
    Ev.updateEvStatus($(this).data('id')).then(data => {
        $("#spinicon").attr("hidden",true);
    }).catch(error => {})
});

$(document).on('click', '.editweigth', function(e) {
    PillaIndexWeigth.getWeigth($('#evid').val(),$(this).data('subpillarindex')).then(data => {
        var weigth = 0.0;
        if(typeof data.weigth !== 'undefined'){
            weigth = data.weigth;
        }  
        $('#weight').val(weigth);
        $('#subpillarindexid').val($(this).data('subpillarindex'));
        $('#modal_edit_weight').modal('show');
    }).catch(error => {})
});

$(document).on('click', '#btn_edit_weight', function(e) {
    PillaIndexWeigth.editWeigth($('#evid').val(),$('#subpillarindexid').val(),$('#weight').val()).then(data => {
        // var weigth = 0.0;
        // if(typeof data.weigth !== 'undefined'){
        //     weigth = data.weigth;
        // }  
        // $('#weight').val(weigth);
        // $('#modal_edit_weight').modal('show');
    }).catch(error => {})
});


$(document).on('click', '#editev', function(e) {
    Ev.editEv($('#evid').val(),$('#evname').val(),$('#version').val(),$('#percentindex').val(),$('#percentextra').val()).then(data => {
        popupmessage = route.popupmessages.find(x => x.id ==55);
        Swal.fire({
            title: popupmessage['title'],
            text: popupmessage['message'],
            });
    })
    .catch(error => {})
});

$(document).on('change', '#evname', function(e) {
    Ev.editEv($('#evid').val(),$('#evname').val(),$('#version').val(),$('#percentindex').val(),$('#percentextra').val()).then(data => {

    }).catch(error => {})
});
$(document).on('change', '#version', function(e) {
    Ev.editEv($('#evid').val(),$('#evname').val(),$('#version').val(),$('#percentindex').val(),$('#percentextra').val()).then(data => {

    }).catch(error => {})
});
$(document).on('change', '#percentindex', function(e) {
    popupmessage = route.popupmessages.find(x => x.id ==41);
    var message = popupmessage['message'];
    if($('#percentindex').val() == 100){
        popupmessage = route.popupmessages.find(x => x.id ==42);
        message = popupmessage['message'];
    }
    Swal.fire({
        title: popupmessage['title'],
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Ev.editEv($('#evid').val(),$('#evname').val(),$('#version').val(),$('#percentindex').val(),$('#percentextra').val()).then(data => {

            }).catch(error => {})
        }else{
            
            $('#percentindex').val(100);
            $('#percentextra').val(0);
        }
    });


});

$(document).on('keyup', '#percentindex', function(e) {
    this.value = this.value.match(/^\d+\.?\d{0,2}/);
    if ($(this).val() > 100){
        $(this).val('100');
    }else if($(this).val() < 0){
        $(this).val('0');
    }
    $('#percentextra').val((100-($(this).val())));
});

$(document).on('keyup', '#percentextra', function(e) {
    this.value = this.value.match(/^\d+\.?\d{0,2}/);
    if ($(this).val() > 100){
        $(this).val('100');
    }else if($(this).val() < 0){
        $(this).val('0');
    }
    $('#percentindex').val((100-($(this).val())));
});

$(document).on('click', '#updateev', function(e) {
    popupmessage = route.popupmessages.find(x => x.id ==43);
    Swal.fire({
        title: popupmessage['title'],
        text: popupmessage['message'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            var pillarnames = $('.pillarname').map(function() {
                return $(this).data('pillar');
            }).toArray();
            
            var unique = pillarnames.filter(onlyUnique);
            if(unique.length != 4){
                popupmessage = route.popupmessages.find(x => x.id ==44);
                Swal.fire({
                    title: popupmessage['title'],
                    text: popupmessage['message'],
                });
                return;
            }
        
            if($("#criteriatable tr").length == 1){
                popupmessage = route.popupmessages.find(x => x.id ==45);
                Swal.fire({
                    title: popupmessage['title'],
                    text: popupmessage['message'],
                })
                return;
            }else{
                if($('#percentextra').val() > 0){
                    if($("#extracriteriatable tr").length == 1){
                        popupmessage = route.popupmessages.find(x => x.id ==46);
                        Swal.fire({
                            title: popupmessage['title'],
                            text: popupmessage['message'],
                        })
                        return;
                    }
                }
            }
            $("#spinicon").attr("hidden",false);
            Ev.updateEvStatus($(this).data('id')).then(data => {
                Ev.clearCommentTab($('#evid').val(),1).then(data => {
                    $("#spinicon").attr("hidden",true);
                    popupmessage = route.popupmessages.find(x => x.id ==47);
                    Swal.fire({
                        title: popupmessage['title'],
                        text: popupmessage['message'],
                    }).then((result) => {
                        window.location.reload();
                    });
                }).catch(error => {})
            }).catch(error => {})
        }
    });
});
function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
  }
$(document).on('click', '#approveevstageone', function(e) {
    popupmessage = route.popupmessages.find(x => x.id ==48);
    Swal.fire({
        title: popupmessage['title'],
        text: popupmessage['message'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            $("#spinicon").attr("hidden",false);
            Ev.approveEvStageOne($(this).data('id')).then(data => {
                $("#spinicon").attr("hidden",true);
                popupmessage = route.popupmessages.find(x => x.id ==49);
                Swal.fire({
                    title: popupmessage['title'],
                    text: popupmessage['message'],
                }).then((result) => {
                    window.location.reload();
                });
            }).catch(error => {})
        }
    });
});

$(document).on('click', '#btnaddextracriteria', function(e) {
    if($('#percentextra').val() == 0){
        popupmessage = route.popupmessages.find(x => x.id ==50);
        Swal.fire({
            title: popupmessage['title'],
            text: popupmessage['message'],
        })
        return;
    }
    Extra.getExtraCategory($('#evid').val()).then(data => {
        var html ='<option value="0" >==เลือกรายการ==</option>';
        data.forEach(function (category,index) {
                html += `<option value="${category['id']}" >${category['name']}</option>`
            });
         $("#extracategory").html(html);
         $("#extracriteria option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
         $('#modal_add_extracriteria').modal('show');
    }).catch(error => {})
});

$(document).on('change', '#extracategory', function(e) {
    var html ='<option value="0" >==เลือกรายการ==</option>';
    Extra.getExtra($('#evid').val(),$(this).val()).then(data => {
        data.forEach(function (criteria,index) {
                html += `<option value="${criteria['id']}" >${criteria['name']}</option>`
            });
        $("#extracriteria").html(html);
    }).catch(error => {})
});

$(document).on('change', '#extrasubpillar', function(e) {
    $(this).prop('selected',true);

    SubPillar.getSubPillarIndex($('#evid').val(),$(this).val()).then(data => {
        var html =``;
        data.subpillarindexs.forEach(function (subpillar,index) {
                html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
            });
        $("#extrasubpillarindex").html(html);
    }).catch(error => {})
});


$(document).on('click', '#btn_modal_add_comment', function(e) {
    if($('#comment').val() == ''){
        return;
    }
    popupmessage = route.popupmessages.find(x => x.id ==51);
    Swal.fire({
        title: popupmessage['title'],
        text: popupmessage['message'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            $("#addcommentspinicon").attr("hidden",false);
            Ev.addCommentStageOne($('#evid').val(),$('#comment').val()).then(data => {
                $("#addcommentspinicon").attr("hidden",true);
                $('#modal_add_comment').modal('hide');
                window.location.reload();
            }).catch(error => {})
        }
    });
});

$('.nav-tabs a').on('shown.bs.tab', function (e) {
    if(route.usertypeid == 6)return;
    if($(e.target).attr("href") == '#commenttab'){
        // Ev.clearCommentTab($('#evid').val(),1).then(data => {
    
        // }).catch(error => {})
    }
});

$(document).on("click",".deletecomment",function(e){
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Ev.deleteComment($(this).data('id')).then(data => {
                var html =``;
                data.forEach(function (comment,index) {
                        html += `<tr > 
                        <td> ${comment.created_at} </td>                                            
                        <td> ${comment.detail} </td>    
                        <td> <a data-id="${comment.id}" class="btn btn-sm bg-danger deletecomment">ลบ</a> </td>                                          
                        </tr>`
                    });
                $("#ev_edit_history_wrapper_tr").html(html);
        
            }).catch(error => {})
        }
    });
}); 

$("#gradea").on('change', function() {
    var gradea = parseInt($("#gradea").val());
    var gradeb = parseInt($("#gradeb").val());
    var gradec = parseInt($("#gradec").val());
    var graded = parseInt($("#graded").val());
    var gradee = parseInt($("#gradee").val());
    if(gradea > countchecklist){
        popupmessage = route.popupmessages.find(x => x.id ==52);
        Swal.fire({
            title: popupmessage['title'],
            text: popupmessage['message'],
            });
        $("#gradea").val('');
        return;
    }

    if((gradea <= gradeb) || (gradea <= gradec) ||(gradea <= graded) ||(gradea <= gradee) ){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกรด A ไม่ถูกต้อง',
            });
        $("#gradea").val('');
    }
    
});

$("#gradeb").on('change', function() {
    var gradea = parseInt($("#gradea").val());
    var gradeb = parseInt($("#gradeb").val());
    var gradec = parseInt($("#gradec").val());
    var graded = parseInt($("#graded").val());
    var gradee = parseInt($("#gradee").val());
    if((gradeb >= gradea) || (gradeb <= gradec) ||(gradeb <= graded) ||(gradeb <= gradee) ){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกรด B ไม่ถูกต้อง',
            });
            $("#gradeb").val('');    
    }
});

$("#gradec").on('change', function() {
    var gradea = parseInt($("#gradea").val());
    var gradeb = parseInt($("#gradeb").val());
    var gradec = parseInt($("#gradec").val());
    var graded = parseInt($("#graded").val());
    var gradee = parseInt($("#gradee").val());
    if((gradec >= gradea) || (gradec >= gradeb) ||(gradec <= graded) ||(gradec <= gradee)){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกรด C ไม่ถูกต้อง',
            });
            $("#gradec").val('');    
    }
});

$("#graded").on('change', function() {
    var gradea = parseInt($("#gradea").val());
    var gradeb = parseInt($("#gradeb").val());
    var gradec = parseInt($("#gradec").val());
    var graded = parseInt($("#graded").val());
    var gradee = parseInt($("#gradee").val());
    if((graded >= gradea) || (graded >= gradeb) ||(graded >= gradec) ||(graded <= gradee)){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกรด D ไม่ถูกต้อง',
            });
        $("#graded").val('');    
    }
});

$("#gradee").on('change', function() {
    var gradea = parseInt($("#gradea").val());
    var gradeb = parseInt($("#gradeb").val());
    var gradec = parseInt($("#gradec").val());
    var graded = parseInt($("#graded").val());
    var gradee = parseInt($("#gradee").val());
    if((gradee >= gradea) || (gradee >= gradeb) ||(gradee >= gradec) ||(gradee >= graded)){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกรด E ไม่ถูกต้อง',
            });
        $("#gradee").val('');    
    }
});
$(document).on("click","#toggletable",function(e){
    if($("#gradea").val() == '' || $("#gradeb").val() == '' || $("#gradec").val() == '' || $("#graded").val() =='' || $("#gradee").val() == ''){
        return ;
    }


    $("#tda").html("ตั้งแต่ " + $("#gradea").val());

    if ((parseInt($("#gradea").val())-parseInt($("#gradeb").val())) > 1) {
        $("#tdb").html($("#gradeb").val() + '-' + (parseInt($("#gradea").val()-1)));
    }else{
        $("#tdb").html($("#gradeb").val());
    }

    if ((parseInt($("#gradeb").val())-parseInt($("#gradec").val())) > 1) {
        $("#tdc").html($("#gradec").val() + '-' + (parseInt($("#gradeb").val()-1)));
    }else{
        $("#tdc").html($("#gradec").val());
    }

    if ((parseInt($("#gradec").val())-parseInt($("#graded").val())) > 1) {
        $("#tdd").html($("#graded").val() + '-' + (parseInt($("#gradec").val()-1)));
    }else{
        $("#tdd").html($("#graded").val());
    }

    if ((parseInt($("#graded").val())-parseInt($("#gradee").val())) > 1) {
        $("#tde").html($("#gradee").val() + '-' + (parseInt($("#graded").val()-1)));
    }else{
        $("#tde").html($("#gradee").val());
    }
    $("#tdf").html('น้อยกว่า ' + $("#gradee").val());

    // $("#te").html("<= " + parseInt($("#graded").val()-1));
    $("#show").toggle();
   $(this).html($("#show").is( ":visible" ) ? "ซ่อน" : "แสดง");
});

$(document).on("click","#btn_modal_add_extracriteria",function(e){
    if($('#evid').val() == '' || $('#extracategory').val() == 0 || $('#extracriteria').val() == 0 ){
        return;
    }
    Extra.addExtra($('#evid').val(),$('#extracategory').val(),$('#extracriteria').val()).then(data => {
        RenderExtraTable(data);
        RowSpanExtra("extracriteriatable");
        $("#extracriteria").html('');
        $('#modal_add_extracriteria').modal('hide');
    }).catch(error => {})
});

$(document).on('click', '.deletecategorytransaction', function(e) {
    if($('#evstatus').val() > 1)return ;
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Extra.deleteCategoryExtraTransaction($('#evid').val(),$(this).data('categoryid')).then(data => {
                // RenderExtraTable(data);
                // RowSpanExtra("extracriteriatable");
                 Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ลบรายการสำเร็จ',
                    }).then((result) => {
                        window.location.reload();
                    });
            })
            .catch(error => {})
        }
    });
});


$(document).on('click', '.deletetriteriatransaction', function(e) {
    if($('#evstatus').val() > 1)return ;
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบรายการ`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Extra.deleteCriteriaExtraTransaction($('#evid').val(),$(this).data('categoryid'),$(this).data('criteriaid')).then(data => {
                // RenderExtraTable(data);
                // RowSpanExtra("extracriteriatable");
                //  Swal.fire({
                //     title: 'สำเร็จ',
                //     text: 'ลบรายการสำเร็จ',
                //     });
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ลบรายการสำเร็จ',
                    }).then((result) => {
                        window.location.reload();
                    });
            })
            .catch(error => {})
        }
    });
});

$(document).on('change', '.comment', function(e) {
    Ev.editCriteriaTransactionComment($(this).data('id'),$(this).val()).then(data => {
    }).catch(error => {})
});

$(document).on('change', '.extracomment', function(e) {
    Ev.editExtraCriteriaTransactionComment($(this).data('id'),$(this).val()).then(data => {
    }).catch(error => {})
});

$(document).on('click', '#togglecomment', function(e) {
    $('.toggle').toggle();
 });
