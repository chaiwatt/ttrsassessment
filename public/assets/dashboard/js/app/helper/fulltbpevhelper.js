import * as Ev from './ev.js';
import * as Pillar from './pillar.js';
import * as SubPillar from './subpillar.js';

var globalNewIndex = 0;
$( document ).ready(function() {
    Ev.getEvByFullTbp($('#fulltbpid').val()).then(data => {
        RenderTable(data);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
    }).catch(error => {})
});


$(document).on('click', '#btnaddclustergroup', function(e) {
    Pillar.getPillar().then(data => {
        var html ='<option value="0" >==เลือกรายการ==</option>';
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
    $("#grade_wrapper").attr("hidden",true);
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
        $('#tmpstepindex').val(newIndex);
        $('#criteriamodal').removeClass('context-menu-one'); 
        if(newIndex > 0){
            $('#criteriamodal').addClass('context-menu-one'); 
            $(function() {
                $.contextMenu({
                    selector: '.context-menu-one', 
                    callback: function(key, options) {
                        var m = "clicked: " + key;
                        console.log($('#tmpstepindex').val() + ' ' + key);
                        if(key == 'add'){
                            $("#parent").html($( "#pillar option:selected" ).text());
                            $('#modal_additem').modal('show');
                        }
                    },
                    items: {
                        "add": {name: "เพิ่ม" , icon: "add"},
                        "edit": {name: "แก้ไข", icon: "edit"},
                        "sep1": "---------",
                        "delete": {name: "ลบ", icon: function(){
                            return 'context-menu-icon context-menu-icon-delete';
                        }}
                    }
                });
                $('.context-menu-one').on('click', function(e){
                    console.log('clicked', this);
            
                })    
            });
        }
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
    },
    onFinished: function (event, currentIndex) {
        if($('#indextype').val() == 1){
            AddGrading();
        }else{
            AddCheckList();
        }
    }
});

// $(document).on('keyup', '#name', function(e) {
//     $('#clientname').html($(this).val());
// });

function AddCheckList(){
    var criterias = [];
    $("#criteria").each(function(i, sel){
        var selectedVal = $(sel).val();
        criterias =selectedVal;
    });

    Ev.addEvCheckList($('#evid').val(),$('#indextype').val(),$('#pillar').val(),$('#subpillar').val(),$('#subpillarindex').val(),criterias,$('#gradea').val(),$('#gradeb').val(),$('#gradec').val(),$('#graded').val(),$('#gradee').val(),$('#gradef').val()).then(data => {
         RenderTable(data);
         RowSpan("criteriatable");
         Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มรายการสำเร็จ!',
            });
    }).catch(error => {})
}

function AddGrading(){
    Ev.addEvGrading($('#evid').val(),$('#indextype').val(),$('#pillar').val(),$('#subpillar').val(),$('#subpillarindex').val()).then(data => {
        RenderTable(data);
        RowSpan("criteriatable");
         Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มรายการสำเร็จ!',
            });
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
            $(".loadprogress").attr("hidden",true);
            RenderTable(data);
            RowSpan("criteriatable");
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
function RenderTable(data){
    var html =``;
    data.forEach(function (criteria,index) {
        var criterianame = '-';
        if(criteria.criteria != null){
            criterianame = criteria.criteria['name']
        }
        var isadmin = '';
        // console.log(route.usertypeid);
        if(route.usertypeid >= 7){
            isadmin = `(<a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" data-subpillarindex="${criteria.subpillarindex['id']}"  class="text-grey-300 editweigth">แก้ไข Weigth</a>)`;
        }
        html += `<tr > 
        <td> ${criteria.pillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" class="text-grey-300 deletepillar"><i class="icon-trash"></i></a></td>                                            
        <td> ${criteria.subpillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" class="text-grey-300 deletesubpillar"><i class="icon-trash"></i></a></td>    
        <td> ${criteria.subpillarindex['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" data-subpillarindex="${criteria.subpillarindex['id']}" class="text-grey-300 deletesubpillarindex"><i class="icon-trash"></i></a> ${isadmin}</td>   
        <td> ${criterianame} </td>                                            
        </tr>`
        });
    $("#criteria_transaction_wrapper_tr").html(html);
}

function RowSpan(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = null;
    let cell2 = null;
    let cell3 = null;
    let cell4 = null;
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

$(document).on('click', '.deletepillar', function(e) {
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
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
                RenderTable(data);
                RowSpan("criteriatable");
                 Swal.fire({
                    title: 'สำเร็จ...',
                    text: 'ลบรายการสำเร็จ!',
                    });
            })
            .catch(error => {})
        }
    });
});


$(document).on('click', '.deletesubpillar', function(e) {
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
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
                RenderTable(data);
                RowSpan("criteriatable");
                 Swal.fire({
                    title: 'สำเร็จ...',
                    text: 'ลบรายการสำเร็จ!',
                    });
            })
            .catch(error => {})
        }
    });
});

$(document).on('click', '.deletesubpillarindex', function(e) {
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
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
                RenderTable(data);
                RowSpan("criteriatable");
                 Swal.fire({
                    title: 'สำเร็จ...',
                    text: 'ลบรายการสำเร็จ!',
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
            console.log(data);
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
            console.log(data);
            var html ='';
            data.forEach(function (subpillar,index) {
                    html += `<option value="${subpillar['id']}" >${subpillar['name']}</option>`
                });
            $("#criteria").html(html);
            $("#criteria option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
            })
        .catch(error => {})
    }


});