import * as Menu from './menu.js'

$("#parentmenu").change(function(){
    if($(this).val()=='')return;
    Menu.getMenu($(this).val()).then(data => {
        console.log(data);
        $('#menuthai').val(data.name);
        $('#menuenglish').val(data.engname);
        $('#menuid').val(data.id);
        if(data.page_id !== null){
            $('#page option[value='+data.page_id+']').prop("selected", true).change();
        }else{
            $('#page option').prop("selected", false).change();
        }
    })
    .catch(error => {
        console.log(error)
    })
});