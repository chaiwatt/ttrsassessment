import * as Geo from './location.js'

// $("#province").change(function(){
$(document).on('change', '#province', function(e) {
    $('#postal').val('');
    $("#tambol").html('');
    
    Geo.amphur($(this).val()).then(data => {
        let  html = "<option value='0'>===เลือกอำเภอ===</option>";
        var i;
        for (i = 0; i < data.length; i++) {
            var n = data[i]['name'].includes("*");
            if(n == false){
                html += `<option value='${data[i]['id']}'>${data[i]['name']}</option>`
            }
        }
        $("#amphur").html(html);
    })
    .catch(error => {

    })
});
$(document).on('change', '#amphur', function(e) {
    Geo.tambol($(this).val()).then(data => {
        console.log(data);
        let  html = "<option value='0'>===เลือกตำบล===</option>";
        var i;
        for (i = 0; i < data.length; i++) {
            var n = data[i]['name'].includes("*");
            if(n == false){
                html += `<option data-id='${data[i]['postal']}' value='${data[i]['id']}'>${data[i]['name']}</option>`
            }
        }
        $("#tambol").html(html);
        $("#tambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
 
    })
});

// $(document).on('change', '#tambol', function(e) {
//   console.log('5lo');
// });



$(document).on('change', '#factoryprovince', function(e) {
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#factoryamphur").html(html);
        $("#factoryamphur option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {

    })
});

$(document).on('change', '#factoryamphur', function(e) {
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#factorytambol").html(html);
        $("#factorytambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {

    })
});

$(document).on('change', '#provincemodal', function(e) {
    Geo.amphur($(this).val()).then(data => {
        let  html = "<option value='0'>===เลือกอำเภอ===</option>";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphurmodal").html(html);
        $("#amphurmodal option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        
    })
});

$(document).on('change', '#amphurmodal', function(e) {
    Geo.tambol($(this).val()).then(data => {
        let  html = "<option value='0'>===เลือกตำบล===</option>";
        data.forEach((tambol,index) => 
            html += `<option data-id='${tambol.postal}' value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#tambolmodal").html(html);
        $("#tambolmodal option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        
    })
});


    