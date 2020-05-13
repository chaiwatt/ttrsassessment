import * as Layout from './layout.js'
Sortable.create(productList, {
    group: "sorting",
    sort: true
});
$('#btnsave').click(function() {
    var list = [];
    $("input:checkbox").each(function(key){
        if ($(this).is(":checked"))
            {
                list.push({
                    id: $(this).data('id'),
                    order: key+1,
                    value: '1',
                });
            }else{
                list.push({
                    id: $(this).data('id'),
                    order: key+1,
                    value: '0',
                });
            }
    });
    Layout.editLayout(list,$("#layout").val()).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'บันทึกรายการเลย์เอาต์สำเร็จ!',
            }).then((result) => {

            })
    })
    .catch(error => {
        //console.log(error)
    })

});