import * as Category from './category.js'

$("#parentcategory").change(function(){
    if($(this).val()=='')return;
    Category.getCategory($(this).val()).then(data => {
        $('#category').val(data.name);
        $('#categoryid').val(data.id);
    })
    .catch(error => {
    })
});