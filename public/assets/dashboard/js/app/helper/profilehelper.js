
var a=0;
$(document).on("click","#btn_modal_expertexpience",function(e){
    a++;
     var html = `
     <div class="row expertexpienceclass${a}" >							
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="expertexpienceposition[${a}]" id="expertexpienceposition${a}" value="${$("#expertexpienceposition").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencecompany[${a}]" id="expertexpiencecompany${a}" value="${$("#expertexpiencecompany").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencedetail[${a}]" id="expertexpiencedetail${a}" value="${$("#expertexpiencedetail").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="fromyear[${a}]" id="fromyear${a}" value="${$("#fromyear").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="toyear[${a}]" id="toyear${a}" value="${$("#toyear").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#expertexpience_wrapper').append(html);
    var tr = `<tr class="expertexpienceclass${a}">	
    <td> ${$('#expertexpiencecompany').val()}</td>                                     
    <td> ${$('#expertexpienceposition').val()}</td>  
    <td> ${$('#fromyear').val()}</td>  
    <td> ${$('#toyear').val()}</td>    
    <td> <a type="button" data-id="expertexpienceclass${a}"  class="btn btn-danger-400 btn-sm deleteexpertexpienceclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#expertexpience_wrapper_tr').append(tr);
});

var b=0;
$(document).on("click","#btn_modal_experteducation",function(e){
    b++;
     var html = `
     <div class="row experteducationclass${b}" >							
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="expertexpienceposition[${b}]" id="expertexpienceposition${b}" value="${$("#expertexpienceposition").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencecompany[${b}]" id="expertexpiencecompany${b}" value="${$("#expertexpiencecompany").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencedetail[${b}]" id="expertexpiencedetail${b}" value="${$("#expertexpiencedetail").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="fromyear[${b}]" id="fromyear${b}" value="${$("#fromyear").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="toyear[${b}]" id="toyear${b}" value="${$("#toyear").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#experteducation_wrapper').append(html);
    var tr = `<tr class="expertexpienceclass${b}">	
    <td> ${$('#expertexpiencecompany').val()}</td>                                     
    <td> ${$('#expertexpienceposition').val()}</td>  
    <td> ${$('#fromyear').val()}</td>  
    <td> ${$('#toyear').val()}</td>    
    <td> <a type="button" data-id="experteducationclass${b}"  class="btn btn-danger-400 btn-sm deleteexperteducationclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#experteducation_wrapper_tr').append(tr);
});