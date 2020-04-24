import * as Drug from './drug.js';

  $("#file").on('change', function() {
      $("#filename").val(this.value);
  });
  $(function () {
      $('#stockupdate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
      });
  });
  $(function () {
      $('#expiredate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
      });
  });

  $(document).on("click","#btn_modal_add_action",function(e){
    if ($("#action").val() =='') return;
    Drug.addUsageAction(route.branchid,$("#action").val()).then(data => {
          let  html = "";
          data.forEach((drugusageaction,index) => 
              html += `<option value='${drugusageaction.id}'>${drugusageaction.action}</option>`
          )
          $("#drugusage_action").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btn_modal_add_frequency",function(e){
    if ($("#frequency").val() =='') return;
    Drug.addUsageFrequency(route.branchid,$("#frequency").val()).then(data => {
          let  html = "";
          data.forEach((drugusagefrequency,index) => 
              html += `<option value='${drugusagefrequency.id}'>${drugusagefrequency.frequency}</option>`
          )
          $("#drugusage_frequency").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btn_modal_add_usetime",function(e){
    if ($("#usetime").val() =='') return;
    Drug.addUsageUsetime(route.branchid,$("#usetime").val()).then(data => {
          let  html = "";
          data.forEach((drugusageusetime,index) => 
              html += `<option value='${drugusageusetime.id}'>${drugusageusetime.usetime}</option>`
          )
          $("#drugusage_usetime").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btneditaction",function(e){
    if ($("#drugusage_action").val() =='') return;
    $("#action_edit").val($( "#drugusage_action option:selected" ).text());
    $('#modal_edit_action').modal('show');
  }); 



   $(document).on("click","#btndeleteaction",function(e){
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drugusage_action option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteUsageAction(route.branchid,$("#drugusage_action").val()).then(data => {
                    let  html = "";
                    data.forEach((drugusageaction,index) => 
                        html += `<option value='${drugusageaction.id}'>${drugusageaction.action}</option>`
                    )
                    $("#drugusage_action").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });


  $(document).on("click","#btn_modal_edit_action",function(e){
    if ($("#action_edit").val() =='') return;
    Drug.editUsageAction(route.branchid,$("#action_edit").val(),$("#drugusage_action").val()).then(data => {
          let  html = "";
          data.forEach((drugusageaction,index) => 
              html += `<option value='${drugusageaction.id}'>${drugusageaction.action}</option>`
          )
          $("#drugusage_action").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btneditfrequency",function(e){
    if ($("#drugusage_frequency").val() =='') return;
    $("#frequency_edit").val($( "#drugusage_frequency option:selected" ).text());
    $('#modal_edit_frequency').modal('show');
  }); 

  $(document).on("click","#btndeletefrequency",function(e){
    if ($("#drugusage_frequency").val() =='') return;
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drugusage_frequency option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteUsageFrequency(route.branchid,$("#drugusage_frequency").val()).then(data => {
                    let  html = "";
                    data.forEach((drugusagefrequency,index) => 
                        html += `<option value='${drugusagefrequency.id}'>${drugusagefrequency.frequency}</option>`
                    )
                    $("#drugusage_frequency").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });

  $(document).on("click","#btn_modal_edit_frequency",function(e){
    if ($("#frequency_edit").val() =='') return;
    Drug.editUsageFrequency(route.branchid,$("#frequency_edit").val(),$("#drugusage_frequency").val()).then(data => {
          let  html = "";
          data.forEach((drugusagefrequency,index) => 
              html += `<option value='${drugusagefrequency.id}'>${drugusagefrequency.frequency}</option>`
          )
          $("#drugusage_frequency").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 
  
  
  $(document).on("click","#btneditusetime",function(e){
    if ($("#drugusage_usetime").val() =='') return;
    $("#usetime_edit").val($( "#drugusage_usetime option:selected" ).text());
    $('#modal_edit_usetime').modal('show');
  }); 

  $(document).on("click","#btndeleteusetime",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบ "${$( "#drugusage_usetime option:selected" ).text()}" หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Drug.deleteUsageUsetime(route.branchid,$("#drugusage_usetime").val()).then(data => {
                let  html = "";
                data.forEach((drugusageusetime,index) => 
                    html += `<option value='${drugusageusetime.id}'>${drugusageusetime.usetime}</option>`
                )
                $("#drugusage_usetime").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
        }
    });
});

  $(document).on("click","#btn_modal_edit_usetime",function(e){
    if ($("#usetime_edit").val() =='') return;
    Drug.editUsageUsetime(route.branchid,$("#usetime_edit").val(),$("#drugusage_usetime").val()).then(data => {
          let  html = "";
          data.forEach((drugusageusetime,index) => 
              html += `<option value='${drugusageusetime.id}'>${drugusageusetime.usetime}</option>`
          )
          $("#drugusage_usetime").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btn_modal_add_unit",function(e){
    if ($("#unit").val() =='') return;
    Drug.addUnit(route.branchid,$("#unit").val()).then(data => {
          let  html = "";
          data.forEach((unit,index) => 
              html += `<option value='${unit.id}'>${unit.name}</option>`
          )
          $("#drug_unit").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btneditunit",function(e){
    if ($("#drug_unit").val() =='') return;
    $("#unit_edit").val($( "#drug_unit option:selected" ).text());
    $('#modal_edit_unit').modal('show');
  }); 

  $(document).on("click","#btn_modal_edit_unit",function(e){
    if ($("#unit_edit").val() =='') return;
    Drug.editUnit(route.branchid,$("#unit_edit").val(),$("#drug_unit").val()).then(data => {
          let  html = "";
          data.forEach((unit,index) => 
              html += `<option value='${unit.id}'>${unit.name}</option>`
          )
          $("#drug_unit").html(html);
      })
      .catch(error => {
          // console.log(error)
      })
  }); 

  $(document).on("click","#btndeleteunit",function(e){
    if ($("#drug_unit").val() =='') return;
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drug_unit option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteUnit(route.branchid,$("#drug_unit").val()).then(data => {
                    let  html = "";
                    data.forEach((unit,index) => 
                        html += `<option value='${unit.id}'>${unit.name}</option>`
                    )
                    $("#drug_unit").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });

    $(document).on("click","#btn_modal_add_vender",function(e){
        if ($("#vender").val() =='') return;
        Drug.addVender(route.branchid,$("#vender").val()).then(data => {
              let  html = "";
              data.forEach((vender,index) => 
                  html += `<option value='${vender.id}'>${vender.name}</option>`
              )
              $("#drug_vender").html(html);
          })
          .catch(error => {
              // console.log(error)
          })
      }); 

    $(document).on("click","#btneditvender",function(e){
    if ($("#drug_vender").val() =='') return;
        $("#vender_edit").val($( "#drug_vender option:selected" ).text());
        $('#modal_edit_vender').modal('show');
    }); 

    $(document).on("click","#btn_modal_edit_vender",function(e){
        if ($("#vender_edit").val() =='') return;
        Drug.editVender(route.branchid,$("#vender_edit").val(),$("#drug_vender").val()).then(data => {
                let  html = "";
                data.forEach((vender,index) => 
                    html += `<option value='${vender.id}'>${vender.name}</option>`
                )
                $("#drug_vender").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
    }); 

    $(document).on("click","#btndeletevender",function(e){
        if ($("#drug_vender").val() =='') return;
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drug_vender option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteVender(route.branchid,$("#drug_vender").val()).then(data => {
                    let  html = "";
                    data.forEach((vender,index) => 
                        html += `<option value='${vender.id}'>${vender.name}</option>`
                    )
                    $("#drug_vender").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });

    $(document).on("click","#btn_modal_add_drugcontrol",function(e){
        if ($("#drugcontrol").val() =='') return;
        Drug.addDrugControl(route.branchid,$("#drugcontrol").val()).then(data => {
                let  html = "";
                data.forEach((drugcontrol,index) => 
                    html += `<option value='${drugcontrol.id}'>${drugcontrol.name}</option>`
                )
                $("#drugcontroltype").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
    }); 
    
    $(document).on("click","#btneditdrugcontrol",function(e){
        if ($("#drugcontroltype").val() =='') return;
        $("#drugcontrol_edit").val($( "#drugcontroltype option:selected" ).text());
        $('#modal_edit_drugcontrol').modal('show');
    }); 

    $(document).on("click","#btn_modal_edit_drugcontrol",function(e){
        if ($("#drugcontrol_edit").val() =='') return;
        Drug.editDrugControl(route.branchid,$("#drugcontrol_edit").val(),$("#drugcontroltype").val()).then(data => {
                let  html = `<option value='0'>===เลือกรายการ===</option>`;
                data.forEach((drugcontrol,index) => 
                    html += `<option value='${drugcontrol.id}'>${drugcontrol.name}</option>`
                )
                $("#drugcontroltype").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
    }); 

    $(document).on("click","#btndeletedrugcontrol",function(e){
        if ($("#drugcontroltype").val() =='') return;
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drugcontroltype option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteDrugControl(route.branchid,$("#drugcontroltype").val()).then(data => {
                    let  html = `<option value='0'>===เลือกรายการ===</option>`;
                    data.forEach((drugcontrol,index) => 
                        html += `<option value='${drugcontrol.id}'>${drugcontrol.name}</option>`
                    )
                    $("#drugcontroltype").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });

    
    $(document).on("click","#btn_modal_add_hint",function(e){
        if ($("#hint").val() =='') return;
        Drug.addHint(route.branchid,$("#hint").val()).then(data => {
                let  html = "";
                data.forEach((hint,index) => 
                    html += `<option value='${hint.id}'>${hint.texthint}</option>`
                )
                $("#drug_hint").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
    }); 

    $(document).on("click","#btnedithint",function(e){
        if ($("#drug_hint").val() =='') return;
        $("#hint_edit").val($( "#drug_hint option:selected" ).text());
        $('#modal_edit_hint').modal('show');
    }); 

    $(document).on("click","#btn_modal_edit_hint",function(e){
        if ($("#drug_hint").val() =='') return;
        Drug.editHint(route.branchid,$("#hint_edit").val(),$("#drug_hint").val()).then(data => {
                let  html = `<option value=''></option>`;
                data.forEach((hint,index) => 
                    html += `<option value='${hint.id}'>${hint.texthint}</option>`
                )
                $("#drug_hint").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
    }); 

    $(document).on("click","#btndeletehint",function(e){
        if ($("#drug_hint").val() =='') return;
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบ "${$( "#drug_hint option:selected" ).text()}" หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Drug.deleteHint(route.branchid,$("#drug_hint").val()).then(data => {
                    let  html = `<option value=''></option>`;
                    data.forEach((hint,index) => 
                        html += `<option value='${hint.id}'>${hint.texthint}</option>`
                    )
                    $("#drug_hint").html(html);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        });
    });

    $('#searchdrug').keyup(function(){   
        if ($(this).val() =='') return;   
        Drug.searchDrug(route.branchid,$(this).val()).then(data => {
            let html='';
            data.forEach(function (search,index) {
                let status ='';
                if (search.drug_usage_status_id == 1) 
                {
                    status =`<span class="badge badge-flat border-success text-success-600">${search.drugusagestatus['name']}</span>` ;
                }else if(search.drug_usage_status_id == 2){
                    status =`<span class="badge badge-flat border-grey text-grey-600">${search.drugusagestatus['name']}</span>` ;
                }
                html += `<tr>
                            <td>${search.name}</td>
                            <td>${search.therapeutic}</td>
                            <td>${search.strength}</td>
                            <td>${status}</td>                          
                            <td>                                                     
                                <a href="${route.url}/setting/drugstore/create?id=${search.id}" class="badge bg-teal">เพิ่มคลัง</a>                                                    
                                <a href="${route.url}/setting/drug/edit/${search.id}" class="badge bg-primary">แก้ไข</a>
                                <a id="deletedrug" href="${route.url}/setting/drug/delete/${search.id}" data-drug="${search.name}" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>  
                            </td>
                        <tr>`
                });
            $("#drugtable_body").html(html);
        })
        .catch(error => {
            // console.log(error)
        })
    });

    $(document).on("click","#btn_modal_add_drug",function(e){
        if ($("#drugname").val() =='' || $("#genericname").val() =='' || $("#printname").val() =='' || $("#therapeutic").val() =='' ) return;
        Drug.addDrugFast(route.branchid,$("#drugname").val(),$("#genericname").val(),$("#printname").val(),$("#therapeutic").val()).then(data => {
            let  html = `<option value=''></option>`;
            data.forEach((drug,index) => 
                html += `<option value='${drug.id}'>${drug.name}</option>`
            )
            $("#drugallergy").html(html);
            // $("#drugallergy option:contains("+$("#drugname").val()+")").attr('selected', true);
             $("#drugallergy option").filter(function(index) { return $(this).text() === $("#drugname").val(); }).attr('selected', 'selected').change();
        })
        .catch(error => {
            // console.log(error)
        })
    }); 