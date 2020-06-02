import * as Category from './category.js'

$("#parentcategory").change(function(){
    console.log($(this).val());
    if($(this).val()=='')return;
    Category.getCategory($(this).val()).then(data => {
        console.log(data);
        $('#category').val(data.name);
        $('#categoryid').val(data.id);
    })
    .catch(error => {
        console.log(error)
    })
});